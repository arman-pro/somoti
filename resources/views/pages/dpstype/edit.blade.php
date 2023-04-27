@extends('layouts.admin')
@section('title', __('Edit DPS Type'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">@lang('Edit DPS Type')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('dpsType.index')}}">@lang("DPS Type List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Edit DPS Type')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('dpsType-index')
                        <a href="{{route('dpsType.index')}}" class="btn btn-sm btn-success">@lang('DPS Type List')</a>
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
            <form action="{{route('dpsType.update', ['dpsType' => $dpsType->id])}}" method="post">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Edit DPS Type')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">@lang('Name')*</label>
                                        <input type="text" name="name" placeholder="@lang('Name')" value="{{$dpsType->name}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror " required/>
                                        @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="code">@lang('Code')*</label>
                                        <input type="text" name="code" placeholder="@lang('Code')" value="{{$dpsType->code}}" id="code" class="form-control form-control-sm @error('code') is-invalid @enderror " required/>
                                        @error('code')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="duration">@lang('Duration Day')*</label>
                                        <input type="text" name="duration" placeholder="@lang('Duration Day')" value="{{$dpsType->duration}}" id="duration" class="form-control form-control-sm @error('duration') is-invalid @enderror " required/>
                                        @error('duration')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="interest_rate">@lang('Interest Rate')* (%)</label>
                                        <input type="number" name="interest_rate" placeholder="@lang('Interest Rate')" value="{{$dpsType->interest_rate}}" id="interest_rate" class="form-control form-control-sm @error('interest_rate') is-invalid @enderror " required/>
                                        @error('interest_rate')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="active_status">@lang('Active Status')*</label>
                                        <br/>
                                        @include('includes.toggle-button', [
                                            'name' => 'active_status',
                                            'value' => "1",
                                            "id" => "active_status",
                                            "checked" => $dpsType->is_active,
                                        ])
                                    </div>
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