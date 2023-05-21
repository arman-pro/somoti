@extends('layouts.admin')
@section('title', __('DPS Collection'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('DPS Collection')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('DPS Collection')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card shadow">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang('DPS Collection')</h4>
                </div>
                <div class="card-body text-center">
                    <form action="{{route('collection.dps')}}" method="get">
                        <input type="hidden" name="search" value="1" />
                        <div class="form-group">
                            <input type="text" name="dps_id" autocomplete="off" class="form-control form-control-sm col-md-6 col-sm-12 m-auto" placeholder="@lang('DPS ID')" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($search && $dps) 
    <div class="row">
        {{-- dps detail --}}
        <div class="col-md-6 col-sm-12">
            <div class="card collapsed-card shadow">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang('DPS Details')</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>                     
                        </button>
                    </div>
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
                                <th>@lang('Comment')</th>
                                <td>{{$dps->comment ?? "N/A"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            {{-- include member card --}}
            @include('includes.member', ['member' => $dps->member, 'collapsed' => true, 'shadow' => 'shadow', 'bg' => 'bg-success'])
        </div>
    </div>

    {{-- dps form --}}
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{route('collection.dps.store', ['dps' => $dps->id])}}" id="loan-store" method="post">
                @csrf
                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger">{{$message}}</div>
                @endforeach
                
                <div class="card shadow">
                    <div class="card-header bg-success">
                        <h4 class="card-title">@lang('Installment List')</h4>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table table-sm text-center">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th style="width:10%;">@lang('Installment No')</th>
                                    <th style="width:100px;">@lang('Paid Status')</th>
                                    <th style="width:10%;">@lang('Date')</th>
                                    <th>@lang('Amount')</th>
                                    <th style="width:25%;">@lang('Paid Date')</th>
                                    <th style="width:20%;">@lang('Paid Amount')</th>
                                    <th>@lang('Received By')</th>
                                </tr>
                            </thead>
                            @forelse ($dps->installmentable as $key => $installment)
                                {{-- hidden input --}}
                                <input type="hidden" name="installmentId[]" value="{{$installment->id}}">
                                <tr>
                                    <td>
                                        @if(!$installment->is_paid)
                                        <div class="icheck-primary icheck-inline">
                                            <input type="checkbox" value="{{$installment->id}}" class="takes" id="takes{{$key}}" name="takes[{{$key}}]" />
                                            <label for="takes{{$key}}">&nbsp;</label>
                                        </div>
                                        @else
                                        <div class="icheck-primary icheck-inline">
                                            <input type="checkbox" value="{{$installment->id}}" id="takes{{$key}}" name="takes[{{$key}}]" disabled checked />
                                            <label for="takes{{$key}}">&nbsp;</label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{$installment->installment_no}}</td>
                                    <td>
                                        <x-active-status 
                                            active-status="{{$installment->is_paid}}" 
                                            off-message="Due"
                                            on-message="Paid"
                                        />
                                    </td>
                                    <td>{{printDateFormat($installment->date)}}</td>
                                    <td>{{number_format($installment->amount, 2)}}</td>
                                    <td style="width:25%;">
                                        @if($installment->paid_date)
                                            {{printDateFormat($installment->paid_date)}}
                                        @else                                                
                                            <div class="form-group" style="min-width:150px;">
                                                <div class="input-group date paid-date" id="loanStartDatePicker{{$key}}" data-target-input="nearest">
                                                    <input type="text" name="paid_date[{{$key}}]" placeholder="@lang('Paid Date')" data-target="#loanStartDatePicker{{$key}}" class="form-control form-control-sm datetimepicker-input" />
                                                    <div class="input-group-append" data-target="#loanStartDatePicker{{$key}}" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td style="width:20%;">
                                        @if($installment->paid_amount)
                                            {{number_format($installment->paid_amount)}}
                                        @else
                                            <input type="number" style="min-width:150px;" min="0" step="any" name="paid_amount[{{$key}}]" class="form-control form-control-sm" placeholder="Paid Amount*" />
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($installment->received_by)
                                            {{optional($installment->receivedBy)->name}}
                                        @else 
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </table>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary" id="submit-button" type="button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection

{{-- extra css --}}
@push('css')
    {{-- date picker --}}
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" />
    {{-- nice selecte --}}
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" crossorigin="anonymous" />
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush

{{-- extra js --}}
@push('js')
{{-- date picker --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
    {{-- sweet alert --}}
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('.paid-date').datetimepicker({
                format: "{{dataFormat()}}",
                date: null,
            });

            $('#submit-button').on('click', function (evt) {
                if(!$('.takes:checked').prop('checked')) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Alert!',
                        text: 'Please select a checkbox',
                    });
                }else {
                    $('#loan-store').submit();
                }                
            });
        });
    </script>
@endpush