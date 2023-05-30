<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{

    public function __construct()
    {
        // set permission
        $this->middleware('permission:expenseCategory-index', ['only' => ['index','show']]);
        $this->middleware('permission:expenseCategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:expenseCategory-update', ['only' => ['edit','update']]);
        $this->middleware('permission:expenseCategory-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::orderBy('id', 'desc')->get();
        return view("pages.expensecategory.index", compact('expenseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.expensecategory.create");
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
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:10'],
        ]);
        $data = $request->all();
        $data['is_active'] = false;
        if($request->is_active) {
            $data['is_active'] = true;
        }
        ExpenseCategory::create($data);
        toast('Expense Category created successfull!', 'success');
        return redirectToRoute('expense-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return view("pages.expensecategory.view", compact('expenseCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        return view("pages.expensecategory.edit", compact('expenseCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:10'],
        ]);
        $data = $request->all();
        $data['is_active'] = false;
        if($request->is_active) {
            $data['is_active'] = true;
        }
        $expenseCategory->update($data);
        toast('Expense Category updated successfull!', 'success');
        return redirectToRoute('expense-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        toast('Expense Category deleted successfull!', 'success');
        return redirectToRoute('expense-category.index');
    }
}
