<?php

namespace App\Http\Controllers;

use App\Models\FdrType;
use App\Http\Controllers\Controller;
use App\Http\Requests\FdrRequest;
use App\Http\Requests\FdrTypeRequest;
use Illuminate\Http\Request;

class FdrTypeController extends Controller
{

    protected $v_path = "pages.fdrtype.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:fdrType-index', ['only' => ['index','show']]);
        $this->middleware('permission:fdrType-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:fdrType-update', ['only' => ['edit','update']]);
        $this->middleware('permission:fdrType-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fdrTypes = FdrType::orderBy('id', 'desc')->get();
        return view($this->v_path . "index", compact('fdrTypes'));
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
     * @param  \App\Http\FdrTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FdrTypeRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        FdrType::create($data);
        alert()->success('Created', 'FDR Type created succesfully!');
        return redirectToRoute("fdrtype.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FdrType  $fdrType
     * @return \Illuminate\Http\Response
     */
    public function show(FdrType $fdrType)
    {
        return view($this->v_path . "view", compact('fdrType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FdrType  $fdrType
     * @return \Illuminate\Http\Response
     */
    public function edit(FdrType $fdrType)
    {
        return view($this->v_path . "edit", compact('fdrType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FdrType  $fdrType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FdrType $fdrType)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        $fdrType->update($data);
        alert()->success('Update', 'FDR Type updated succesfully!');
        return redirectToRoute("fdrtype.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FdrType  $fdrType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FdrType $fdrType)
    {
        $fdrType->delete();
        alert()->success('Deleted', 'FDR Type deleted succesfully!');
        return redirectToRoute("fdrtype.index");
    }
}
