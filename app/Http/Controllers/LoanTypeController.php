<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoanTypeRequest;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{

    protected $v_path = "pages.loantype.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:loanType-index', ['only' => ['index','show']]);
        $this->middleware('permission:loanType-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:loanType-update', ['only' => ['edit','update']]);
        $this->middleware('permission:loanType-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanTypes = LoanType::orderBy('id', 'desc')->get();
        return view($this->v_path . "index", compact('loanTypes'));
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
     * @param  \App\Http\LoanTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanTypeRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        LoanType::create($data);
        alert()->success('Created', 'Loan Type created succesfully!');
        return redirectToRoute("loanType.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanType  $loanType
     * @return \Illuminate\Http\Response
     */
    public function show(LoanType $loanType)
    {
        return view($this->v_path . "view", compact('loanType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanType  $loanType
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanType $loanType)
    {
        return view($this->v_path . "edit", compact('loanType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\LoanTypeRequest  $request
     * @param  \App\Models\LoanType  $loanType
     * @return \Illuminate\Http\Response
     */
    public function update(LoanTypeRequest $request, LoanType $loanType)
    {
        $data = $request->all();
        $data['is_active'] = false;
        if($request->active_status) {
            $data['is_active'] = true;
        }
        $loanType->update($data);
        alert()->success('Updated', 'Loan Type updated succesfully!');
        return redirectToRoute("loanType.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanType  $loanType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanType $loanType)
    {
        $loanType->delete();
        alert()->success('Deleted', 'Loan Type deleted succesfully!');
        return redirectToRoute("loanType.index");
    }
}
