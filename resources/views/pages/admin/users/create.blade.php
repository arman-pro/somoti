@extends('layouts.admin')
@section('title', __('Create User'))

{{-- page header --}}
@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Create User')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item "><a href="{{route("dashboard")}}">@lang('Dashboard')</a></li>
                <li class="breadcrumb-item active">@lang('Create User')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a href="{{route('users')}}" class="btn btn-sm btn-success">@lang('User List')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
<div class="row">
    <div class="col-sm-12">
        {{-- users table --}}
        <form action="{{route('users.create')}}" method="post">
            @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('Create User')</h4>
            </div>
            <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">@lang('Name')</label>
                                <input type="text" name="name" placeholder="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror ">
                                @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email">@lang('E-mail')</label>
                                <input type="text" name="email" placeholder="E-mail" value="{{old('email')}}" id="email" class="form-control @error('email') is-invalid @enderror "/>
                                @error('email')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="phone">@lang('Phone')</label>
                                <input type="tel" name="phone" placeholder="Phone" value="{{old('phone')}}" id="phone" class="form-control @error('phone') is-invalid @enderror "/>
                                @error('phone')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="password">@lang('Password')</label>
                                <input type="password" name="password" placeholder="password" id="password" class="form-control" autocomplete="off" autocomplete="new-password"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email">@lang('Active Status')</label>
                                <br/>
                                <input
                                    type="checkbox"
                                    name="active_status"
                                    value="1"
                                    data-toggle="toggle"
                                    data-onstyle="success"
                                    data-offstyle="warning"
                                />
                            </div>
                        </div>
                        @if(auth()->user()->level == 'Super Admin')
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="role_id">@lang('User Role')</label>
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="" hidden>Select User Role</option>
                                    @if(!$roles->isEmpty())
                                        @foreach ($roles as $role)
                                            <option @if(auth()->user()->hasRole($role->name)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('role_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                            </div>
                        </div>
                        @endif
                    </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">@lang('Save')</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

{{-- page extra css cdn --}}
@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

{{-- page extra js cdn --}}
@push('js')
    <!-- Bootstrap Switch -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush

@push('js')
<script>
    $(document).ready(function(){
        $('input[name="active_status"]').on('change', function(){
            if($(this).is(":checked")) {
                $(this).val(1);
            }else{
                $(this).val(0);
            }
        })
    });
</script>
@endpush
