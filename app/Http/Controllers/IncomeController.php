<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function __construct()
    {
        // set permission
        $this->middleware('permission:income-index', ['only' => ['index','show']]);
        $this->middleware('permission:income-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:income-update', ['only' => ['edit','update']]);
        $this->middleware('permission:income-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       if(request()->ajax()) {
            return $this->incomeList();
       }
        $categories = IncomeCategory::orderBy('id', 'desc')->get();
        return view("pages.income.index", compact('categories'));
    }

    public function incomeList()
    {
        $income = Income::with(['incomeCategory'])->orderBy('id', 'desc');
        return Datatables()->eloquent($income)
        ->addIndexColumn()
        ->editColumn('date', function(Income $income) {
            return printDateFormat($income->date);
        })
        ->addColumn('action', function(Income $income) {
            return view('action.income', compact('income'));
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.income.create");
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
            'date' => ['required', 'date_format:'.filterDateFormat().''],
            'incomecategory_id' => ['required'],
            'amount' => ['required'],
        ]);
        $data = $request->all();
        $data['date'] = saveDateFormat($data['date']);
        if(!$request->voucher_no) {
            $data['voucher_no'] = generateIncomeVoucharNo();
        }
        Income::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Income create successfull!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return view("pages.income.view", compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        return view("pages.income.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'date' => ['required', 'date_format:'.filterDateFormat().''],
            'incomecategory_id' => ['required'],
            'amount' => ['required'],
        ]);
        $data = $request->all();
        $data['date'] = saveDateFormat($data['date']);
        $income->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Income update successfull!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();
        return response()->json([
            'success' => true,
            'message' => 'Income deleted successfull!',
        ]);
        
    }
}
