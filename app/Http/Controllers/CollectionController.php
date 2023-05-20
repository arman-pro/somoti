<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use DB;

class CollectionController extends Controller
{
    protected string $v_path = 'pages.collection';

    // set permission
    public function __construct()
    {
        $this->middleware('permission:loan-collection', ['only' => ['loanCollection']]);
    }

    /**
     * get loan collection
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loanCollection(Request $request)
    {
        $search = $request->search ?? false;
        $loan = null;
        if($request->member) {
            $loan = Loan::with(['installmentable', 'member', 'loanType'])->where('member_id', $request->member)->latest()->first();
        }
        $members = Member::select('id', 'name as text')->whereIsActive(true)->get();
        return view($this->v_path . '.loan', compact('members', 'search', 'loan'));
    }

    /**
     * store loan collection
     * @return \Illuminate\Http\Request $request
     */
    public function storeLoanCollection(Request $request, Loan $loan) {
        $request->validate([
            'takes' => ['required', 'array', 'min:1'],
            'installmentId' => ['required', 'array', 'min:1'],
            'paid_date' => ['required', 'array', 'min:1'],
            'paid_date.*' => ['nullable', 'date_format:' . filterDateFormat() . ''],
            'paid_amount' => ['required', 'array', 'min:1'],
        ]);

        DB::beginTransaction();
        try {        
            foreach($request->takes as $key => $installment_id) {
                $paidAmount = $request->paid_amount[$key];
                $installment = Installment::find($installment_id);
                $installment->paid_date = saveDateFormat($request->paid_date[$key]);
                $installment->paid_amount = $paidAmount;
                $installment->is_paid = ($installment->paid_amount == $installment->amount) ?? false;
                $installment->received_by = \Auth::id();
                $installment->save();

                $loan->paid_amount = $paidAmount ?? 0;
                $loan->is_paid = ($loan->paid_amount == $loan->amount) ?? false;
                $loan->save();

                $loan->member()->update([
                    'loan_paid_amount' => $loan->member->loan_paid_amount += ($paidAmount ?? 0),
                ]);
            }
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            alert()->success("Error!", 'Something went worng!');
        }
        alert()->success("Ok!", 'Loan taken successfull!');
        return redirectToRoute("collection.loan");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
