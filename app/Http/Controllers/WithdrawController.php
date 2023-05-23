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
