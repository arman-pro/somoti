<?php

namespace App\Http\Controllers;

use App\Models\Dps;
use App\Http\Controllers\Controller;
use App\Http\Requests\DpsRequest;
use App\Models\DpsType;
use App\Models\Member;
use Illuminate\Http\Request;

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
        $dpses = collect([]);
        return view($this->v_path . "index", compact("dpses"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dps  $dps
     * @return \Illuminate\Http\Response
     */
    public function show(Dps $dps)
    {
        return view($this->v_path . "view", compact('dps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dps  $dps
     * @return \Illuminate\Http\Response
     */
    public function edit(Dps $dps)
    {
        return view($this->v_path . "edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dps  $dps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dps $dps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dps  $dps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dps $dps)
    {
        //
    }
}
