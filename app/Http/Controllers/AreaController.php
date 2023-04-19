<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    protected $v_path = "pages.area.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:area-index', ['only' => ['index','show']]);
        $this->middleware('permission:area-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:area-update', ['only' => ['edit','update']]);
        $this->middleware('permission:area-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::with(['branch'])->orderBy('code', 'asc')->get();
        return view($this->v_path . "index", compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::whereIsActive(true)->get();
        return view($this->v_path . "create", compact("branches"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        Area::create($data);
        alert()->success("Created", 'Area created successfull!');
        return redirectToRoute("area.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $branches = Branch::whereIsActive(true)->get();
        return view($this->v_path . "edit", compact('area', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, Area $area)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        $area->update($data);
        alert()->success("Updated", 'Area updated successfull!');
        return redirectToRoute("area.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        alert()->success("Deleted", 'Area deleted successfull!');
        return redirectToRoute("area.index");
    }
}
