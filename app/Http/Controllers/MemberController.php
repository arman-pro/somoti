<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    protected $v_path = "pages.member.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:member-index', ['only' => ['index','show']]);
        $this->middleware('permission:member-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:member-update', ['only' => ['edit','update']]);
        $this->middleware('permission:member-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = collect([]);
        return view($this->v_path . "index", compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['branches'] = Branch::select('id', 'name as text')
            ->with([
                'areas' => function($query) {
                    return $query->select('id','name as text','branch_id')->whereIsActive(true);
                },
                'areas.groups' => function($query) {
                    return $query->select('id','name as text','area_id')->whereIsActive(true);
                }
            ])
            ->whereIsActive(true)->get();
        return view($this->v_path . "create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view($this->v_path . "edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
