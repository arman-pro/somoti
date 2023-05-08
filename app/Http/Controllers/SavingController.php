<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Http\Controllers\Controller;
use App\Http\Requests\SavingRequest;
use App\Models\Branch;
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
     * @param \Iluuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            return $this->datatables($request);
        }
        $branches = Branch::select('id', 'name')
        ->with(['areas:id,name as text,branch_id','areas.groups:id,name as text,area_id','areas.groups.members:id,name as text,group_id'])
        ->whereIsActive(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "index", compact("branches"));
    }

    public function datatables($request)
    {
        $date = saveDateFormat($request->date);
        $savings = Saving::with([
            'member:id,name,group_id',
            'member.group:id,name,area_id',
            'member.group.area:id,name,branch_id',
            'member.group.area.branch:id,name'
        ])
        ->when($date, function($query, $date) {
            return $query->whereDate('date', $date);
        })
        ->when($request->branch, function($query)use($request) {
            return $query->whereRelation('member.group.area.branch', 'id', $request->branch);
        })
        ->when($request->area, function($query)use($request) {
            return $query->whereRelation('member.group.area', 'id', $request->area);
        })
        ->when($request->group, function($query)use($request) {
            return $query->whereRelation('member.group', 'id', $request->group);
        })
        ->when($request->member, function($query)use($request) {
            return $query->whereRelation('member', 'id', $request->member);
        })
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
        if(request()->ajax()) {
            return view('json.saving_details', compact('saving'));
        }
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
        $members = Member::whereIsActive(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "edit", compact("saving", "members"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\SavingRequest  $request
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(SavingRequest $request, Saving $saving)
    {
        $data = $request->all();
        $data['date'] = saveDateFormat($data['date']);
        // update saving amount
        $member = $saving->member;
        $currentWalletAmount = ($member->saving_amount - $saving->amount) + $data['amount'];
        $saving->member()->update(['saving_amount' => $currentWalletAmount]);
        $saving->update($data);
        alert()->success('Update', 'Savings updated succesfully!');
        return redirectToRoute("savings.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saving $saving)
    {
        $member = $saving->member;
        $currentWalletAmount = ($member->saving_amount - $saving->amount);
        $saving->member()->update(['saving_amount' => $currentWalletAmount]);
        $saving->delete();
        alert()->success('Deleted', 'Savings deleted succesfully!');
        return redirectToRoute("savings.index");
    }
}
