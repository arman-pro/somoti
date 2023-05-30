@extends('layouts.admin')
@section('title', __('Expense Category Edit'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">@lang('Expense Category Edit')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('expense-category.index')}}">@lang("Expense Category List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Expense Category Edit')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('expenseCategory-index')
                        <a href="{{route('expense-category.index')}}" class="btn btn-sm btn-success">@lang('Expense Category List')</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{route('expense-category.update', ['expense_category' => $expenseCategory->id])}}" method="post">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Card Title')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" placeholder="@lang('Name')" value="{{$expenseCategory->name}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror ">
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="code">@lang('Code')</label>
                                    <input type="text" name="code" placeholder="@lang('Code')" value="{{$expenseCategory->code}}" id="code" class="form-control form-control-sm @error('code') is-invalid @enderror "/>
                                    @error('code')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">@lang('Note')</label>
                            <textarea name="note" id="note" cols="30" rows="2" class="form-control" placeholder="@lang('Note')">{{$expenseCategory->note}}</textarea>
                        </div
                        <div class="form-group">
                            <label for="is_active">@lang('Active Status')*</label>
                            <br/>
                            @include('includes.toggle-button', [
                                'name' => 'is_active',
                                'value' => "1",
                                "id" => "is_active",
                                "checked" => "{{$expenseCategory->is_active}}"
                            ])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- extra css --}}
@push('css')

@endpush

{{-- extra js --}}
@push('js')

@endpush