<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    protected string $v_path = "pages.withdraw.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:savings-withdraw', ['only' => ['savingWithdraw']]);
        $this->middleware('permission:fdr-withdraw', ['only' => ['fdrWithdraw']]);
        $this->middleware('permission:withdraw-list', ['only' => ['list']]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function list(Request $request, $member) 
    {
        if($request->ajax() && $request->type == 'saving') {
            return $this->savingWithdrawList($member, 'saving');
        }
        if($request->ajax() && $request->type == 'fdr') {
            return $this->fdrWithdrawList($member, 'fdr');
        }
        $member = Member::findOrFail($member);
        return view('pages.member.withdraw-list', compact('member'));
    }

    public function savingWithdrawList($member, $type)
    {
        $withdraws = Withdraw::where('withdraw_type', $type)->whereMemberId($member);
        return Datatables()->eloquent($withdraws)
        ->addIndexColumn()
        ->setRowId('id')
        ->editColumn('withdraw_type', function (Withdraw $withdraw) {
            return ucfirst($withdraw->withdraw_type);
        })
        ->editColumn('date', function (Withdraw $withdraw) {
            return printDateFormat($withdraw->date);
        })
        ->make();
    }

    public function fdrWithdrawList($member, $type)
    {
        $withdraws = Withdraw::where('withdraw_type', $type)->whereMemberId($member);
        return Datatables()->eloquent($withdraws)
        ->addIndexColumn()
        ->setRowId('id')
        ->editColumn('withdraw_type', function (Withdraw $withdraw) {
            return ucfirst($withdraw->withdraw_type);
        })
        ->editColumn('date', function (Withdraw $withdraw) {
            return printDateFormat($withdraw->date);
        })
        ->make();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function savingWithdraw()
    {
        $members = Member::whereIsActive(true)->get();
        return view($this->v_path . 'savings', compact('members'));
    }

    /**
     * store saving withdraw
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function savingWithdrawStore(Request $request) 
    {
        $request->validate([
            'date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'member_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'comment' => ['nullable', 'max:1500'],
        ]);
        $data = $request->all();
        $data['withdraw_type'] = 'saving';
        $withdraw = Withdraw::create($data);
        $withdraw->member()->update([
            'saving_withdraw_amount' => $withdraw->member->saving_withdraw_amount += ($request->amount ?? 0),
        ]);
        return response()->json([
            "success" => true,
            "message" => 'Saving withdraw successfull!',
        ]);
    }


    public function fdrWithdraw()
    {
        $members = Member::whereIsActive(true)->get();
        return view($this->v_path . 'fdr', compact('members'));
    }

    public function fdrWithdrawStore(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'member_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'comment' => ['nullable', 'max:1500'],
        ]);
        $data = $request->all();
        $data['withdraw_type'] = 'fdr';
        $withdraw = Withdraw::create($data);
        $withdraw->member()->update([
            'fdr_amount_withdraw' => $withdraw->member->fdr_amount_withdraw += ($request->amount ?? 0),
        ]);
        return response()->json([
            "success" => true,
            "message" => 'FDR withdraw successfull!',
        ]);
    }

}
