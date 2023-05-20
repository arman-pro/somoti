@extends('layouts.admin')
@section('title', __('Loan Collection'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Loan Collection')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Loan Collection')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    {{-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">                    
                    <a href="javascript:void(0)" class="btn btn-sm btn-success">@lang('Add Loan Collection')</a>                    
                </div>
            </div>
        </div>
    </div> --}}

    
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Loan Collection')</h4>
                </div>
                <div class="card-body">
                    <form action="{{route("collection.loan")}}" method="get">
                        <input type="hidden" name="search" value="1">
                        <div class="form-group">
                            {{-- <input type="text" name="member_no" class="form-control form-control-sm" placeholder="@lang('Member No.')" /> --}}
                            <select name="member" id="member" class="form-control">
                                <option value="" hidden>@lang('Select a Member')</option>
                                @forelse ($members as $member)
                                    <option value="{{$member->id}}">{{$member->text}}</option>
                                @empty                                    
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="search">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($search && $loan)
        {{-- loan details --}} 
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card collapsed-card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Loan Details')</h4>
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
                                    <td>
                                        <b>@lang('Loan Type'):</b> {{$loan->loanType->name}}
                                    </td>
                                    <td>
                                        <b>@lang('Loan Amount'):</b> {{number_format($loan->amount, 2)}}
                                    </td>
                                    <td>
                                        <b>@lang('Loan Interest'):</b> {{$loan->interest}}%
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <b>@lang('Total Amount Payable'):</b> {{number_format($loan->total_amount_payable ?? 0, 2)}}
                                    </td>
                                    <td>
                                        <b>@lang('Installment Number'):</b> {{$loan->installment_number ?? 0}}
                                    </td>
                                    <td>
                                        <b>@lang('Installment Amount'):</b> {{number_format($loan->installment_amount ?? 0, 2)}}
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>
                                        <b>@lang('Insurence Amount'):</b> {{number_format($loan->insurence_amount ?? 0, 2)}}
                                    </td>
                                    <td>
                                        <b>@lang('Loan Fee'):</b> {{number_format($loan->loan_fee ?? 0, 2)}}
                                    </td>
                                    <td>
                                        <b>@lang('Loan Start Date'):</b> {{printDateFormat($loan->loan_start_date)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>@lang('Loan End Date'):</b> {{printDateFormat($loan->loan_end_date)}}
                                    </td>
                                    <td>
                                        <b>@lang('Paid Amount'):</b> {{$loan->paid_amount ?? 0.00}}
                                    </td>
                                    <td>
                                        <b>@lang('Paid Status'):</b> <x-active-status 
                                            active-status="{{$loan->is_paid}}" 
                                            off-message="Due"
                                            on-message="Paid"
                                        />
                                    </td>                               
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                @include('includes.member', ['member' => $loan->member, 'collapsed' => true])
            </div>
        </div>
        {{-- installment --}}
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form action="{{route('collection.loan.store', ['loan' => $loan->id])}}" id="loan-store" method="post">
                    @csrf
                    @foreach ($errors->all() as $message)
                        <div class="alert alert-danger">{{$message}}</div>
                    @endforeach
                    
                    <div class="card">
                        <div class="card-header">
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
                                @forelse ($loan->installmentable as $key => $installment)
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
    {{-- bootstrap select 2 --}}
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    {{-- bootstrap 4 select 2 theme --}}
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    {{-- nice selecte --}}
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" crossorigin="anonymous" />
    {{-- sweet alert --}}
   <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush

@push('js')
    {{-- date picker --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
    {{-- bootstrap select 2 --}}
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    {{-- sweet alert --}}
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

{{-- extra js --}}
@push('js')
<script>
    $(document).ready(function () {

        $('.paid-date').datetimepicker({
            format: "{{dataFormat()}}",
            date: null,
        });

        $('#member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Member')",
        });

        $('#submit-button').on('click', function (evt) {
            if(!$('.takes:checked').prop('checked')) {
                Swal.fire({
                    icon: 'info',
                    title: 'Alert!',
                    text: 'Please select a checkbox',
                });
            }
            $('#loan-store').submit();
        });

        
    });
</script>
@endpush