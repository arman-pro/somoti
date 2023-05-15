@extends('layouts.admin')
@section('title', __('Loan Details'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Loan Details')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('loan.index')}}">@lang("Loan List")</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Loan Details')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('loan-index')
                        <a href="{{route('loan.index')}}" class="btn btn-sm btn-success">@lang('Loan List')</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-4 col-sm-12">
            @include('includes.member', ['member' => $loan->member])
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Loan Details')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-sm table-bordered">
                        <tbody class="text-center">
                            <tr>
                                <td>
                                    <b>@lang('Loan Type')</b> Type One
                                </td>
                                <td>
                                    <b>@lang('Loan Amount')</b> 5000
                                </td>
                                <td>
                                    <b>@lang('Loan Interest')</b> 5%
                                </td>
                                <td>
                                    <b>@lang('Total Amount Payable')</b> 5%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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