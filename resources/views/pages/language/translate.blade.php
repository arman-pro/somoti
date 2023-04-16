@extends('layouts.admin')
@section('title', __('Translate Language'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Translate Language')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('language.index') }}">@lang('All Language')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Translate Language')</li>
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
            <form action="{{route('translate.store', ['language' => $language->id])}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Translate Language')</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Column')</th>
                                    <th>@lang('Translate')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($transable) > 0)
                                    @foreach ($transable as $key => $tran)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $tran }}</td>
                                            <td>
                                                <input type="text" name="transable[{{ $tran }}]"
                                                    value="{{$translate[$tran] ?? ""}}"
                                                    class="form-control form-control-sm" autocomplete="false" />
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
