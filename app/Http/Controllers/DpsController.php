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
        Dps::create($data);
        alert()->success('Created', 'DPS created succesfully!');
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
        $dps->update($data);
        alert()->success('Updated', 'DPS updated succesfully!');
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
        $dps->delete();
        alert()->success('Deleted', 'DPS deleted succesfully!');
        return redirectToRoute("dps.index");
    }
}
