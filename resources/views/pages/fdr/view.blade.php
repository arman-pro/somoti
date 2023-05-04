@extends('layouts.admin')
@section('title', __('FDR Details'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('FDR Details')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('fdr.index')}}">@lang("FDR List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('FDR Details')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('fdr-index')
                        <a href="{{route('fdr.index')}}" class="btn btn-sm btn-success">@lang('FDR List')</a>
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
            {{-- include member card --}}
            @include('includes.member', ['member' => $fdr->member])
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('FDR Details')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>@lang('Date')</th>
                                <td>{{printDateFormat($fdr->date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Start Date')</th>
                                <td>{{printDateFormat($fdr->start_date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Expire Date')</th>
                                <td>{{printDateFormat($fdr->expire_date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('DPS Type')</th>
                                <td>{{optional($fdr->fdrType)->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Interest Rate')</th>
                                <td>{{optional($fdr->fdrType)->interest_rate}}%</td>
                            </tr>
                            <tr>
                                <th>@lang('FDR Amount')</th>
                                <td>{{$fdr->fdr_amount}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Ref. Member')</th>
                                <td>{{optional($fdr->referMember)->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Ref. User')</th>
                                <td>{{optional($fdr->referUser)->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Comment')</th>
                                <td>{{$fdr->comment ?? "N/A"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            {{-- dps details --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('FDR Installment')</h4>
                </div>
                <div class="card-body">

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