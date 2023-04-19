<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Area;
use App\Models\Branch;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    protected $v_path = "pages.group.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:group-index', ['only' => ['index','show']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-update', ['only' => ['edit','update']]);
        $this->middleware('permission:group-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with(['area', 'area.branch'])->get();
        return view($this->v_path . "index", compact("groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::whereIsActive(true)->get();
        $areas = Area::select('id', 'name as text', 'branch_id')->whereIsActive(true)->get();
        return view($this->v_path . "create", compact("areas", "branches"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status){
            $data['is_active'] = true;
        }
        Group::create($data);
        alert()->success("Created", 'Group created successfull!');
        return redirectToRoute("group.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $branches = Branch::whereIsActive(true)->get();
        $areas = Area::select('id', 'name as text', 'branch_id')->whereIsActive(true)->get();
        return view($this->v_path . "edit", compact('group', 'branches', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status){
            $data['is_active'] = true;
        }
        $group->update($data);
        alert()->success("Updated", 'Group updated successfull!');
        return redirectToRoute("group.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        alert()->success("Deleted", 'Group deleted successfull!');
        return redirectToRoute("group.index");
    }
}
