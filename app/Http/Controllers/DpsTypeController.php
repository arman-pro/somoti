<?php

namespace App\Http\Controllers;

use App\Models\DpsType;
use App\Http\Controllers\Controller;
use App\Http\Requests\DpsTypeRequest;
use Illuminate\Http\Request;

class DpsTypeController extends Controller
{

    protected $v_path = "pages.dpstype.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:dpsType-index', ['only' => ['index','show']]);
        $this->middleware('permission:dpsType-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dpsType-update', ['only' => ['edit','update']]);
        $this->middleware('permission:dpsType-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dpsTypes = DpsType::orderBy('id', 'desc')->get();
        return view($this->v_path . "index", compact('dpsTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->v_path . "create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DpsTypeRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        DpsType::create($data);
        alert()->success('Created', 'DPS Type created succesfully!');
        return redirectToRoute("dpsType.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DpsType  $dpsType
     * @return \Illuminate\Http\Response
     */
    public function show(DpsType $dpsType)
    {
        return view($this->v_path . "view", compact('dpsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DpsType  $dpsType
     * @return \Illuminate\Http\Response
     */
    public function edit(DpsType $dpsType)
    {
        return view($this->v_path . "edit", compact('dpsType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DpsType  $dpsType
     * @return \Illuminate\Http\Response
     */
    public function update(DpsTypeRequest $request, DpsType $dpsType)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        $dpsType->update($data);
        alert()->success('Updated', 'DPS Type updated succesfully!');
        return redirectToRoute("dpsType.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DpsType  $dpsType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DpsType $dpsType)
    {
        $dpsType->delete();
        alert()->success('Deleted', 'DPS Type deleted succesfully!');
        return redirectToRoute("dpsType.index");
    }
}
