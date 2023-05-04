<?php

namespace App\Http\Controllers;

use App\Models\Fdr;
use App\Http\Controllers\Controller;
use App\Http\Requests\FdrRequest;
use App\Models\FdrType;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Blade;

class FdrController extends Controller
{

    protected $v_path = "pages.fdr.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:fdr-index', ['only' => ['index','show']]);
        $this->middleware('permission:fdr-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:fdr-update', ['only' => ['edit','update']]);
        $this->middleware('permission:fdr-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->datatables();
        }
        return view($this->v_path . "index");
    }

    public function datatables()
    {
        $dpses = Fdr::with(['member:id,name,member_no', 'fdrType:id,name'])->orderBy('id', 'desc');
        return DataTables()->eloquent($dpses)
        ->addIndexColumn()
        ->editColumn('date', function(Fdr $fdr) {
            return printDateFormat($fdr->date);
        })
        ->editColumn('start_date', function(Fdr $fdr) {
            return printDateFormat($fdr->start_date);
        })
        ->editColumn('expire_date', function(Fdr $fdr) {
            return printDateFormat($fdr->expire_date);
        })
        ->addColumn('status', function(Fdr $fdr) {
            return Blade::render('<x-active-status
                active-status="'.$fdr->is_matured.'"
                on-message="'.__('Matured').'"
                off-message="'.__('Running').'"
                on-type="danger"
                off-type="success"
            />');
        })
        ->addColumn('action', function(Fdr $fdr) {
            return view('action.fdr', compact('fdr'));
        })
        ->rawColumns(['action', 'status'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::whereIsActive(true)->orderBy('id', 'desc')->get();
        $fdrTypes = FdrType::whereIsActive(true)->orderBy('id', 'desc')->get();
        $users = User::whereActiveStatus(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "create", compact('members', 'fdrTypes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\FdrRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FdrRequest $request)
    {
        $data = $request->all();
        $data = $request->all();
        $data['start_date']     = saveDateFormat($data['start_date']);
        $data['expire_date']    = saveDateFormat($data['expire_date']);
        $data['date']           = saveDateFormat($data['date']);
        Fdr::create($data);
        alert()->success('Created', 'FDR created succesfully!');
        return redirectToRoute("fdr.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fdr  $fdr
     * @return \Illuminate\Http\Response
     */
    public function show(Fdr $fdr)
    {
        return view($this->v_path . "view", compact('fdr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fdr  $fdr
     * @return \Illuminate\Http\Response
     */
    public function edit(Fdr $fdr)
    {
        $members = Member::whereIsActive(true)->orderBy('id', 'desc')->get();
        $fdrTypes = FdrType::whereIsActive(true)->orderBy('id', 'desc')->get();
        $users = User::whereActiveStatus(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "edit", compact('fdr', 'members', 'fdrTypes', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\FdrRequest  $request
     * @param  \App\Models\Fdr  $fdr
     * @return \Illuminate\Http\Response
     */
    public function update(FdrRequest $request, Fdr $fdr)
    {
        $data = $request->all();
        $data = $request->all();
        $data['start_date']     = saveDateFormat($data['start_date']);
        $data['expire_date']    = saveDateFormat($data['expire_date']);
        $data['date']           = saveDateFormat($data['date']);
        $fdr->update($data);
        alert()->success('Updated', 'FDR updated succesfully!');
        return redirectToRoute("fdr.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fdr  $fdr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fdr $fdr)
    {
        $fdr->delete();
        alert()->success('Deleted', 'FDR deleted succesfully!');
        return redirectToRoute("fdr.index");
    }
}
