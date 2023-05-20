<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use DataTables;

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
        $member = Member::first();
        if(request()->ajax()) {
            return $this->members();
        }
        return view($this->v_path . "index");
    }

    public function members()
    {
        $members = Member::select('id', 'join_date', 'name', 'member_no', 'account', 'group_id', 'is_active')->
        with(['group:id,name,area_id', 'group.area:id,name,branch_id', 'group.area.branch:id,name'])
        ->orderBy('id', 'desc');
        return DataTables()->eloquent($members)
        ->addIndexColumn()
        ->editColumn('join_date', function(Member $member) {
            return printDateFormat($member->join_date);
        })
        ->editColumn('is_active', function(Member $member) {
            if($member->is_active) {
                return "<span class='badge badge-success'>".__('Active')."</span>";
            }
            return "<span class='badge badge-danger'>".__('Deactive')."</span>";
        })
        ->addColumn('action', function(Member $member) {
            return view("action.member", compact('member'));
        })
        ->rawColumns(['action', 'is_active'])
        ->toJson();
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
    public function store(MemberRequest $request)
    {
        $data = $request->all();
        $extra_info['member_info'] = $request->info;
        $extra_info['member_info']['date_of_birth'] = saveDateFormat($extra_info['member_info']['date_of_birth']);
        $extra_info['member_address']['present'] = $request->address;
        $extra_info['member_address']['permanent'] = $request->permanentAddress;
        $extra_info['nominee'] = $request->nominee;

        $file = [];
        $upload_path = "public/member";
        if($request->hasFile('member.nid')) {
            $file['member_docs']['nid'] = fileUpload($request, 'member.nid', $upload_path);
        }
        if($request->hasFile('member.other_document')) {
            $file['member_docs']['other_document'] = fileUpload($request, 'member.other_document', $upload_path);
        }
        if($request->hasFile("nominee_docs.nid")) {
            $file['nominee_docs']['nid'] = fileUpload($request, 'nominee_docs.nid', $upload_path);
        }
        if($request->hasFile("nominee_docs.other_document")) {
            $file['nominee_docs']['other_document'] = fileUpload($request, 'nominee_docs.other_document', $upload_path);
        }
        if($request->hasFile("memberProfile")) {
            $file['profile']['member'] = fileUpload($request, 'memberProfile', $upload_path);
        }
        if($request->hasFile("nomineeProfile")) {
            $file['profile']['nominee'] = fileUpload($request, 'nomineeProfile', $upload_path);
        }
        $extra_info['file'] = $file;
        $data['extra_info'] = json_encode($extra_info);
        $data['member_no'] = generateUniqueMemberNo();
        $data['account'] = generateUniqueAccount();
        $data['join_date'] = saveDateFormat($data['join_date']);
        Member::create($data);
        alert()->success("Created", 'Member created successfull!');
        return redirectToRoute("member.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $extra_info = json_decode($member->extra_info);
        return view($this->v_path .'view', compact('member', 'extra_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $branches = Branch::select('id', 'name as text')
            ->with([
                'areas' => function($query) {
                    return $query->select('id','name as text','branch_id')->whereIsActive(true);
                },
                'areas.groups' => function($query) {
                    return $query->select('id','name as text','area_id')->whereIsActive(true);
                }
            ])
            ->whereIsActive(true)->get();
        $extra_info = json_decode($member->extra_info);
        return view($this->v_path . "edit", compact('member', 'branches', 'extra_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        $data = $request->all();
        $extra_info['member_info'] = $request->info;
        $extra_info['member_info']['date_of_birth'] = saveDateFormat($extra_info['member_info']['date_of_birth']);
        $extra_info['member_address']['present'] = $request->address;
        $extra_info['member_address']['permanent'] = $request->permanentAddress;
        $extra_info['nominee'] = $request->nominee;

        $file = [];
        $upload_path = "public/member/";
        $ex_info = json_decode($member->extra_info);
        if($request->hasFile('member.nid')) {
            if(optional(optional($ex_info->file)->member_docs)->nid) {
                unlink(storage_path($upload_path . '' .$ex_info->file->member_docs->nid));
            }
            $file['member_docs']['nid'] = fileUpload($request, 'member.nid', $upload_path);
        }
        if($request->hasFile('member.other_document')) {
            if(optional(optional($ex_info->file)->member_docs)->other_document) {
                unlink(storage_path($upload_path . '' .$ex_info->file->member_docs->other_document));
            }
            $file['member_docs']['other_document'] = fileUpload($request, 'member.other_document', $upload_path);
        }
        if($request->hasFile("nominee_docs.nid")) {
            if(optional(optional($ex_info->file)->nominee_docs)->nid) {
                unlink(storage_path($upload_path . '' .$ex_info->file->nominee_docs->nid));
            }
            $file['nominee_docs']['nid'] = fileUpload($request, 'nominee_docs.nid', $upload_path);
        }
        if($request->hasFile("nominee_docs.other_document")) {
            if(optional(optional($ex_info->file)->nominee_docs)->other_document) {
                unlink(storage_path($upload_path . '' .$ex_info->file->nominee_docs->other_document));
            }
            $file['nominee_docs']['other_document'] = fileUpload($request, 'nominee_docs.other_document', $upload_path);
        }
        if($request->hasFile("memberProfile")) {
            if(optional(optional($ex_info->file)->profile)->member) {
                unlink(storage_path($upload_path . '' .$ex_info->file->profile->member));
            }
            $file['profile']['member'] = fileUpload($request, 'memberProfile', $upload_path);
        }
        if($request->hasFile("nomineeProfile")) {
            if(optional(optional($ex_info->file)->profile)->nominee) {
                unlink(storage_path($upload_path . '' .$ex_info->file->profile->nominee));
            }
            $file['profile']['nominee'] = fileUpload($request, 'nomineeProfile', $upload_path);
        }
        $extra_info['file'] = $file;
        $data['extra_info'] = json_encode($extra_info);
        $data['join_date'] = saveDateFormat($data['join_date']);
        $member->update($data);
        alert()->success("Updated", 'Member updated successfull!');
        return redirectToRoute("member.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $upload_path = "public/member/";
        $ex_info = json_decode($member->extra_info);
        if(optional(optional($ex_info->file)->member_docs)->nid) {
            unlink(storage_path($upload_path . '' .$ex_info->file->member_docs->nid));
        }
        if(optional(optional($ex_info->file)->member_docs)->other_document) {
            unlink(storage_path($upload_path . '' .$ex_info->file->member_docs->other_document));
        }
        if(optional(optional($ex_info->file)->nominee_docs)->nid) {
            unlink(storage_path($upload_path . '' .$ex_info->file->nominee_docs->nid));
        }
        if(optional(optional($ex_info->file)->nominee_docs)->other_document) {
            unlink(storage_path($upload_path . '' .$ex_info->file->nominee_docs->other_document));
        }
        if(optional(optional($ex_info->file)->profile)->member) {
            unlink(storage_path($upload_path . '' .$ex_info->file->profile->member));
        }
        if(optional(optional($ex_info->file)->profile)->nominee) {
            unlink(storage_path($upload_path . '' .$ex_info->file->profile->nominee));
        }
        $member->delete();
        alert()->success("Deleted", 'Member deleted successfull!');
        return redirectToRoute("member.index");
    }
}
