@extends('layouts.admin')
@section('title', __('DPS Details'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('DPS Details')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('dps.index')}}">@lang("DPS List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('DPS Details')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('dps-index')
                        <a href="{{route('dps.index')}}" class="btn btn-sm btn-success">@lang('DPS List')</a>
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
            @include('includes.member', ['member' => $dps->member])
            {{-- dps details --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('DPS Details')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>@lang('Date')</th>
                                <td>{{printDateFormat($dps->date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Start Date')</th>
                                <td>{{printDateFormat($dps->start_date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Expire Date')</th>
                                <td>{{printDateFormat($dps->expire_date)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('DPS Type')</th>
                                <td>{{optional($dps->dpsType)->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Interest Rate')</th>
                                <td>{{optional($dps->dpsType)->interest_rate}}%</td>
                            </tr>
                            <tr>
                                <th>@lang('Amount Per Installment')</th>
                                <td>{{$dps->amount_per_installment}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Number Of Installment')</th>
                                <td>{{$dps->number_of_installment}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Profit')</th>
                                <td>{{$dps->profit}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Total Amount')</th>
                                <td>{{$dps->total_amount}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Paid Amount')</th>
                                <td>{{$dps->paid_amount}}</td>
                            </tr>
                            <tr>
                                <th>@lang('Matured Status')</th>
                                <td>
                                    <x-active-status 
                                        active-status="{{$dps->is_matured}}"
                                        off-message="Running"
                                        on-message="Matured"
                                        off-type="success"
                                        on-type="danger"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('Comment')</th>
                                <td>{{$dps->comment ?? "N/A"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('DPS Installment')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-sm text-center">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Installment No')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Paid Date')</th>
                                <th>@lang('Paid Amount')</th>
                                <th>@lang('Paid Status')</th>
                                <th>@lang('Received By')</th>
                            </tr>
                        </thead>
                        @forelse ($dps->installmentable as $installment)
                            <tr rowspan="{{$installment->note ? 1 : 0}}" >
                                <td>{{$loop->iteration}}</td>
                                <td>{{$installment->installment_no}}</td>
                                <td>{{printDateFormat($installment->date)}}</td>
                                <td>{{number_format($installment->amount, 2)}}</td>
                                <td>
                                    @if($installment->paid_date)
                                        {{printDateFormat($installment->paid_date)}}
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                <td>{{$installment->paid_amount ?? "N/A"}}</td>
                                <td>
                                    <x-active-status 
                                        active-status="{{$installment->is_paid}}" 
                                        off-message="Due"
                                        on-message="Paid"
                                    />
                                </td>
                                <td>
                                    @if($installment->received_by)
                                        {{optional($installment->receivedBy)->name}}
                                    @else 
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            @if($installment->note)
                            <tr>
                                <td class="text-left" colspan="7"><b>Note:</b> {{$installment->note ?? "N/A"}}</td>
                            </tr>
                            @endif
                        @empty
                            
                        @endforelse
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