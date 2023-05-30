<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function __construct()
    {
        // set permission
        $this->middleware('permission:account-index', ['only' => ['index','show']]);
        $this->middleware('permission:account-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:account-update', ['only' => ['edit','update']]);
        $this->middleware('permission:account-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::orderBy('id', 'desc')->get();
        return view("pages.account.index", compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.account.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:10'],
        ]);
        $data = $request->all();
        $data['is_active'] = false;
        if($request->is_active) {
            $data['is_active'] = true;
        }
        Account::create($data);
        toast('Account created successfull!', 'success');
        return redirectToRoute('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view("pages.account.view", compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view("pages.account.edit", compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:10'],
        ]);
        $data = $request->all();
        $data['is_active'] = false;
        if($request->is_active) {
            $data['is_active'] = true;
        }
        $account->update($data);
        toast('Account updated successfull!', 'success');
        return redirectToRoute('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        toast('Account deleted successfull!', 'success');
        return redirectToRoute('account.index');
    }
}
