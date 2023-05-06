<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavingRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Datatables;

class SavingController extends Controller
{

    protected $v_path = "pages.saving.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:savings-index', ['only' => ['index','show']]);
        $this->middleware('permission:savings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:savings-update', ['only' => ['edit','update']]);
        $this->middleware('permission:savings-destroy', ['only' => ['destroy']]);
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
        $savings = Saving::with([
            'member:id,name,group_id',
            'member.group:id,name,area_id',
            'member.group.area:id,name,branch_id',
            'member.group.area.branch:id,name'
        ])
        ->orderBy('id', 'desc');
        $preBalance = 0;
        $tempAmount = 0;
        $totalBalance = 0;
        return Datatables()->eloquent($savings)
        ->addIndexColumn()
        ->editColumn('date', function(Saving $saving) {
            return printDateFormat($saving->date);
        })
        ->addColumn('pre_balance', function(Saving $saving) use(&$preBalance, &$tempAmount) {
            $preBalance += $tempAmount; $tempAmount = $saving->amount;
            return $preBalance;
        })
        ->addColumn('total_balance', function(Saving $saving) use(&$totalBalance) {
            return ($totalBalance += $saving->amount);
        })
        ->addColumn('action', function(Saving $saving) {
            return view('action.saving', compact('saving'));
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::whereIsActive(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "create", compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\SavingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavingRequest $request)
    {
        $data = $request->all();
        $data['date'] = saveDateFormat($data['date']);
        if(!$request->voucher_no) {
            $data['voucher_no'] = SavingVchGenerate();
        }
        $saving = Saving::create($data);
        $member = $saving->member;
        // update saving amount
        $member->update([
            'saving_amount' => $member->saving_amount += $data['amount'],
        ]);
        alert()->success('Created', 'Savings created succesfully!');
        return redirectToRoute("savings.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show(Saving $saving)
    {
        return view($this->v_path . "view", compact('saving'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        return view($this->v_path . "edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saving $saving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saving $saving)
    {
        //
    }
}
