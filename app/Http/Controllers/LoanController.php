<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Branch;
use App\Models\LoanType;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Blade;

class LoanController extends Controller
{

    protected $v_path = "pages.loan.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:loan-index', ['only' => ['index','show']]);
        $this->middleware('permission:loan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:loan-update', ['only' => ['edit','update']]);
        $this->middleware('permission:loan-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->loan_list();
        }
        return view($this->v_path . "index");
    }

    public function loan_list() {
        $loans = Loan::with(['member:id,name', 'loanType:id,name'])
        ->orderBy('id', 'desc');
        return DataTables()->eloquent($loans)
        ->only(['id', 'date', 'interest', 'member.name', 'loan_type.name', 'status', 'action', 'amount', 'total_amount_payable'])
        ->editColumn('date', function (Loan $loan) {
            return printDateFormat($loan->date);
        })
        ->editColumn('interest', '{{$interest}}%')
        ->editColumn('status', function (Loan $loan) {
            return Blade::render('<x-active-status
                active-status="'.$loan->is_paid.'"
                on-message="'.__('Paid').'"
                off-message="'.__('Running').'"
                on-type="danger"
                off-type="success"
            />');
        })
        ->addColumn('action', function (Loan $loan) {
            return view('action.loan', compact('loan'));
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
        $members = Member::select('id', 'name', 'mobile', 'account')->whereIsActive(true)->orderBy('id', 'desc')->get();
        $loantypes = LoanType::select('id', 'name', 'interest_rate')->whereIsActive(true)->orderBy('id', 'desc')->get();
        $users = User::select("id", 'name')->whereActiveStatus(true)->orderBy('id', 'desc')->get();
        return view($this->v_path . "create", compact("members", "loantypes", "users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\LoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $data = $request->all();
        $data['date'] = saveDateFormat($data['date']);
        $data['loan_start_date'] = saveDateFormat($data['loan_start_date']);
        $data['loan_end_date'] = saveDateFormat($data['loan_end_date']);
        $data['refer_user_id'] = $data['ref_user_id'];
        $data['refer_member_id'] = $data['ref_member_id'];
        $extra_info['guarantor_name'] = $request->guarantor_name;
        $extra_info['guarantor_father'] = $request->guarantor_father;
        $extra_info['guarantor_relation'] = $request->guarantor_relation;
        $extra_info['guarantor_phone'] = $request->guarantor_phone;
        $extra_info['bank_account_number'] = $request->bank_account_number;
        $extra_info['check_number'] = $request->check_number;
        $extra_info['file_upload'] = null;
        $extra_info['security_docs'] = null;

        $upload_path = "public/loan/";
        if($request->hasFile('file_upload')) {
            $extra_info['file_upload'] = fileUpload($request, 'file_upload', $upload_path);
        }
        if($request->hasFile('security_docs')) {
            $extra_info['security_docs'] = fileUpload($request, 'security_docs', $upload_path);
        }

        $data['extra_info'] = json_encode($extra_info);
        Loan::create($data);
        alert()->success("Created", 'Loan created successfull!');
        return redirectToRoute("loan.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view($this->v_path . "view", compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        return view($this->v_path . "edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
