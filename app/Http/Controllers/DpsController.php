<?php

namespace App\Http\Controllers;

use App\Models\Dps;
use App\Http\Controllers\Controller;
use App\Http\Requests\DpsRequest;
use App\Models\DpsType;
use App\Models\Member;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Blade;
use DB;
use Exception;

class DpsController extends Controller
{

    protected $v_path = "pages.dps.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:dps-index', ['only' => ['index','show']]);
        $this->middleware('permission:dps-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dps-update', ['only' => ['edit','update']]);
        $this->middleware('permission:dps-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->datatables();
        }
        return view($this->v_path . "index");
    }

    public function datatables()
    {
        $dpses = Dps::with(['member:id,name,member_no', 'dpsType:id,name'])->orderBy('id', 'desc');
        return DataTables()->eloquent($dpses)
        ->addIndexColumn()
        ->editColumn('date', function(Dps $dps) {
            return printDateFormat($dps->date);
        })
        ->editColumn('start_date', function(Dps $dps) {
            return printDateFormat($dps->start_date);
        })
        ->editColumn('expire_date', function(Dps $dps) {
            return printDateFormat($dps->expire_date);
        })
        ->addColumn('status', function(Dps $dps) {
            return Blade::render('<x-active-status
                active-status="'.$dps->is_matured.'"
                on-message="'.__('Matured').'"
                off-message="'.__('Running').'"
                on-type="danger"
                off-type="success"
            />');
        })
        ->addColumn('action', function(Dps $dps) {
            return view('action.dps', compact('dps'));
        })
        ->rawColumns(['action', 'status'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::select('id', 'name', 'account', 'mobile')->whereIsActive(true)->get();
        $dpsTypes = DpsType::select('id', 'name', 'interest_rate')->whereIsActive(true)->get();
        return view($this->v_path . "create", compact('members', 'dpsTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DpsRequest $request)
    {
        $data = $request->all();
        $data['start_date']     = saveDateFormat($data['start_date']);
        $data['expire_date']    = saveDateFormat($data['expire_date']);
        $data['date']           = saveDateFormat($data['date']);
        $data['dps_id']         = generateDpsId();

        DB::beginTransaction();
        try {
            $dps = Dps::create($data);
            $installment_amount = $dps->amount_per_installment;
            $installment_date = $dps->start_date;
            $total_installment = $dps->number_of_installment;
            for ($i=0; $i < $total_installment; $i++) { 
                $dps->installmentable()->create([
                    'installment_no' => generateInstallmentNo(),
                    'date' => $installment_date,
                    'amount' => $installment_amount,
                ]);
                $installment_date_num = strtotime('+30 days' , strtotime($installment_date));
                $installment_date = date('Y-m-d', $installment_date_num);
            }
            DB::commit();
            alert()->success('Created', 'DPS created succesfully!');
        }catch(\Exception $e) {
            DB::rollback();
            alert()->error('Error', 'Something went worng!');
        }
        return redirectToRoute("dps.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $dp
     * @return \Illuminate\Http\Response
     */
    public function show($dp)
    {
        $dps = Dps::findOrFail($dp);
        return view($this->v_path . "view", compact('dps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $dp
     * @return \Illuminate\Http\Response
     */
    public function edit($dp)
    {
        $dps = Dps::findOrFail($dp);
        $members = Member::select('id', 'name', 'account', 'mobile')->whereIsActive(true)->get();
        $dpsTypes = DpsType::select('id', 'name', 'interest_rate')->whereIsActive(true)->get();
        return view($this->v_path . "edit", compact('dps', 'members', 'dpsTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\DpsRequest  $request
     * @param  it  $dp
     * @return \Illuminate\Http\Response
     */
    public function update(DpsRequest $request, $dp)
    {
        $data = $request->all();
        $data['start_date']     = saveDateFormat($data['start_date']);
        $data['expire_date']    = saveDateFormat($data['expire_date']);
        $data['date']           = saveDateFormat($data['date']);

        $dps = Dps::findOrFail($dp);
        
        DB::beginTransaction();
        try {
            $dps->update($data);

            $installment_amount = $dps->amount_per_installment;
            $installment_date = $dps->start_date;
            $total_installment = $dps->number_of_installment;

            $dps->installmentable()->delete();

            for ($i=0; $i < $total_installment; $i++) { 
                $dps->installmentable()->create([
                    'installment_no' => generateInstallmentNo(),
                    'date' => $installment_date,
                    'amount' => $installment_amount,
                ]);
                $installment_date_num = strtotime('+30 days' , strtotime($installment_date));
                $installment_date = date('Y-m-d', $installment_date_num);
            }
            DB::commit();
            alert()->success('Updated', 'DPS updated succesfully!');
        }catch(Exception $e) {
            DB::rollback();
            alert()->error('Error', 'Something went worng!');
        }
        return redirectToRoute("dps.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $dp
     * @return \Illuminate\Http\Response
     */
    public function destroy($dp)
    {
        $dps = Dps::findOrFail($dp);
        DB::beginTransaction();
        try{
            $dps->installmentable()->delete();
            $dps->delete();
            DB::commit();
            alert()->success('Deleted', 'DPS deleted succesfully!');
        }catch(\Exception $e) {
            DB::rollback();
            alert()->error('Error', 'Something went worng!');
        }
        
        return redirectToRoute("dps.index");
    }
}
