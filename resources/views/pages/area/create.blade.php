@extends('layouts.admin')
@section('title', __('Add New Area'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Add New Area')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Add New Area')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('area-index')
                        <a href="{{route('area.index')}}" class="btn btn-sm btn-success">@lang('Area List')</a>
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
            <form action="{{route('area.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Add New Area')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="branch">@lang('Branch')*</label>
                                    <select
                                        name="branch_id"
                                        id="branch" class="form-control @error('branch_id') is-invalid @enderror"
                                        data-placeholder="Select a Branch"
                                        data-allowClear="true"
                                        required
                                    >
                                        <option value="" hidden>@lang('Select a Branch')</option>
                                        @forelse ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                    @error('email')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')*</label>
                                    <input type="text" name="name" placeholder="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror ">
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="code">@lang('Code')*</label>
                                    <input type="tel" name="code" placeholder="Code" value="{{old('code')}}" id="code" class="form-control @error('code') is-invalid @enderror ">
                                    @error('code')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">@lang('Active Status')*</label>
                                    <br/>
                                    <input
                                        type="checkbox"
                                        name="active_status"
                                        value="1"
                                        data-toggle="toggle"
                                        data-onstyle="success"
                                        data-offstyle="warning"
                                        checked
                                    />
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
{{-- Bootstrap Switch --}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
{{-- bootstrap select 2 --}}
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
{{-- bootstrap 4 select 2 theme --}}
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

{{-- extra js --}}
@push('js')
 <!-- Bootstrap Switch -->
 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
 {{-- bootstrap select 2 --}}
 <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
@endpush

{{-- extra js for this page --}}
@push('js')
<script>
    $(function() {
        $("#branch").select2({
            "theme": "bootstrap4",
            "placeholder": "Select a Branch",
            allowClear: true
        });
    });
</script>
@endpush