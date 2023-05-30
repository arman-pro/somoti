<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{

    public function __construct()
    {
        // set permission
        $this->middleware('permission:incomeCategory-index', ['only' => ['index','show']]);
        $this->middleware('permission:incomeCategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:incomeCategory-update', ['only' => ['edit','update']]);
        $this->middleware('permission:incomeCategory-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomeCategories = IncomeCategory::orderBy('id', 'desc')->get();
        return view("pages.incomecategory.index", compact('incomeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.incomecategory.create");
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
        IncomeCategory::create($data);
        toast('Income Category created successfull!', 'success');
        return redirectToRoute('income-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeCategory $incomeCategory)
    {
        return view("view", compact('incomeCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeCategory $incomeCategory)
    {
        return view("pages.incomecategory.edit", compact('incomeCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeCategory $incomeCategory)
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
        $incomeCategory->update($data);
        toast('Income Category updated successfull!', 'success');
        return redirectToRoute('income-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeCategory $incomeCategory)
    {
        $incomeCategory->delete();
        toast('Income Category deleted successfull!', 'success');
        return redirectToRoute('income-category.index');
    }
}
