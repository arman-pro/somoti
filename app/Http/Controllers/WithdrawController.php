<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
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

    public function savingWithdraw()
    {
        $members = Member::whereIsActive(true)->get();
        return view($this->v_path . 'savings', compact('members'));
    }


    public function fdrWithdraw()
    {
        $members = Member::whereIsActive(true)->get();
        return view($this->v_path . 'fdr', compact('members'));
    }

}
