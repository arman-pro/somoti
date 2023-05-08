@extends('layouts.admin')
@section('title', __('Savings Details'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Savings Details')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('savings.index')}}">@lang("Savings List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Savings Details')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('saving-index')
                        <a href="{{route('savings.index')}}" class="btn btn-sm btn-success">@lang('Savings List')</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Savings Details')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th>@lang('Date')</th>
                                <td>{{printDateFormat($saving->date)}}</td>
                                <th>@lang("Voucher No")</th>
                                <td>{{$saving->voucher_no}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Amount')</th>
                                <td>{{$saving->amount}}</td>
                                <th>@lang("Comment")</th>
                                <td>{{$saving->comment}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            @include('includes.member', ['member' => $saving->member])
        </div>
    </div>

@endsection

{{-- extra css --}}
@push('css')

@endpush

{{-- extra js for this page --}}
@push('js')
    <script>

    </script>
@endpush