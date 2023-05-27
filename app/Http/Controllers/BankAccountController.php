<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use App\Models\Branch;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Contracts\DataTable;

class BankAccountController extends Controller
{

    protected $v_path = "pages.bankaccount.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:bank-index', ['only' => ['index', 'show']]);
        $this->middleware('permission:bank-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bank-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bank-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:bank-transaction-list', ['only' => ['transaction']]);
        $this->middleware('permission:bank-transaction-add', ['only' => ['transactionStore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankAccounts = BankAccount::all();
        return view("pages.bankaccount.index", compact('bankAccounts'));
    }

    public function transaction()
    {
        if(request()->ajax()) {
            return $this->transactions();
        }
        $bankAccounts = BankAccount::all();
        return view('pages.bankaccount.transaction', compact("bankAccounts"));
    }

    public function transactions()
    {
        $transactions = BankTransaction::with(['bank:id,name,branch_id', 'bank.branch:id,name'])->orderBy('id', 'desc');
        return DataTables()->eloquent($transactions)
        ->editColumn('date', function(BankTransaction $bankTransaction) {
            return printDateFormat($bankTransaction->date);
        })
        ->editColumn('amount', function(BankTransaction $bankTransaction) {
            return number_format($bankTransaction->amount, 2);
        })
        ->addColumn('action', function (BankTransaction $bankTransaction) {
            return view('action.bank-transaction', compact('bankTransaction'));
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function transactionEdit()
    {

    }

    /**
     * store bank transaction
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function transactionStore(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date_format:' . filterDateFormat() . ''],
            'bank_account' => ['required'],
            'amount' => ['required'],
            'transaction_type' => ['required'],
            'note' => ['nullable'],
        ]);
        $data = $request->all();

        $bank = BankAccount::findOrFail($request->bank_account);
        if ($bank && $bank->balance < $request->amount && $request->transaction_type == 'withdraw') {
            toast('Balance is short!', 'warning');
            return redirectToRoute("bank-account.transaction");
        }

        DB::beginTransaction();
        try {
            $data['bankaccount_id'] = $data['bank_account'];
            $bankTransaction = BankTransaction::create($data);

            if ($bankTransaction->transaction_type == 'withdraw') {
                $bankTransaction->bank()->update([
                    'balance' => $bankTransaction->bank->balance -= $request->amount ?? 0,
                ]);
            } elseif ($bankTransaction->transaction_type == 'deposit') {
                $bankTransaction->bank()->update([
                    'balance' => $bankTransaction->bank->balance += $request->amount ?? 0,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            abort(404, 'Something went worng!');
            return;
        }
        return response()->json([
            'success' => true,
            'message' => 'Bank Transaction create successfull!',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::whereIsActive(true)->get();
        return view($this->v_path . "create", compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'unique:bankaccounts,name'],
            'ac_number' => ['required'],
            'note' => ['nullable'],
        ]);
        $data = $request->all();
        BankAccount::create($data);
        alert()->success("Created", 'Bank account created successfull!');
        return redirectToRoute("bank-account.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        return view("pages.bankaccount.view", compact('bankAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        $branches = Branch::whereIsActive(true)->get();
        return view("pages.bankaccount.edit", compact('bankAccount', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'unique:bankaccounts,name,' . $bankAccount->id],
            'ac_number' => ['required'],
            'note' => ['nullable'],
        ]);
        $data = $request->all();
        $bankAccount->update($data);
        alert()->success("Updated", 'Bank account updated successfull!');
        return redirectToRoute("bank-account.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        alert()->success("Deleted", 'Bank account delete successfull!');
        return redirectToRoute("bank-account.index");
    }
}
