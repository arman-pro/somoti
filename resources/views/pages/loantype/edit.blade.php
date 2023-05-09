@extends('layouts.admin')
@section('title', __('Edit Loan Type'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">@lang('Edit Loan Type')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('loanType.index')}}">@lang("Loan Type List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Edit Loan Type')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('loanType-index')
                        <a href="{{route('loanType.index')}}" class="btn btn-sm btn-success">@lang('Loan Type List')</a>
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
            <form action="{{route('loanType.update', ['loanType' => $loanType->id])}}" method="post">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Edit Loan Type')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')*</label>
                                    <input type="text" name="name" placeholder="@lang('Name')" value="{{$loanType->name}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror " required/>
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="code">@lang('Code')*</label>
                                    <input type="text" name="code" placeholder="@lang("Code")" value="{{$loanType->code}}" id="code" class="form-control form-control-sm @error('code') is-invalid @enderror " required />
                                    @error('code')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="day_repay">@lang('Day Repay')*</label>
                                    <input type="number" name="day_repay" placeholder="@lang('Day Repay')" value="{{$loanType->day_repay}}" id="day_repay" class="form-control form-control-sm @error('day_repay') is-invalid @enderror " required/>
                                    @error('day_repay')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="interest_rate">@lang('Interest Rate')%*</label>
                                    <input type="number" name="interest_rate" placeholder="@lang('Interest Rate')" value="{{$loanType->interest_rate}}" id="interest_rate" class="form-control form-control-sm @error('interest_rate') is-invalid @enderror " required/>
                                    @error('interest_rate')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="active_status">@lang('Active Status')*</label>
                                    <br/>
                                    @include('includes.toggle-button', [
                                        'name' => 'active_status',
                                        'value' => "1",
                                        "id" => "active_status",
                                        "checked" => $loanType->is_active
                                    ])
                                </div>
                            </div>
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