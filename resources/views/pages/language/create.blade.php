@extends('layouts.admin')
@section('title', __('Create Language'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Create Language')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Create Language')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a href="{{ route('language.index') }}" class="btn btn-sm btn-success">@lang('All Language')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{route('language.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Create Language')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="title">@lang('Title')*</label>
                                    <input type="text" name="title" placeholder="{{__('Title')}}" value="{{ old('title') }}"
                                        id="title" class="form-control form-control-sm @error('title') is-invalid @enderror " required />
                                    @error('title')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="slug">@lang('Slug')*</label>
                                    <input type="text" name="slug" placeholder="{{__('Slug')}}" value="{{ old('Slug') }}"
                                        id="Slug" class="form-control form-control-sm @error('Slug') is-invalid @enderror " required />
                                    @error('Slug')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">@lang('Save')</button>
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
