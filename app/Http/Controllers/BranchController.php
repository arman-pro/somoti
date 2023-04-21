<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    protected $v_path = "pages.branches.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:branch-index', ['only' => ['index','show']]);
        $this->middleware('permission:branch-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:branch-update', ['only' => ['edit','update']]);
        $this->middleware('permission:branch-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::orderBy('code', 'asc')->get();
        return view($this->v_path . "index", compact('branches'));
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
    public function store(BranchRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        Branch::create($data);
        alert()->success("Created", 'Branch created successfull!');
        return redirectToRoute("branch.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view($this->v_path . "edit", compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        $branch->update($data);
        alert()->success("Updated", 'Branch updated successfull!');
        return redirectToRoute("branch.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        alert()->success("Deleted", 'Branch deleted successfull!');
        return redirectToRoute("branch.index");
    }
}
