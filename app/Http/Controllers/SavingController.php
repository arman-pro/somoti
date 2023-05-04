<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

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
        return view($this->v_path . "index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax() && request()->has('member')) {
            $member = Member::findOrFail(request()->member);
            return view('includes.member', compact("member"));
        }

        $members = Member::whereIsActive(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "create", compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
