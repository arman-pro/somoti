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
            <div class="card">
                <div class="card-header">
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
            <div class="card collapsed-card">
                <div class="card-header">
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
            @include('includes.member', ['member' => $dps->member, 'collapsed' => true])
        </div>
    </div>

    {{-- dps form --}}
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">@lang('DPS Collection')</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="date">@lang('Date')</label>
                                <div class="input-group date" id="datePicker" data-target-input="nearest">
                                    <input type="text" name="datePicker" placeholder="@lang('Paid Date')" data-target="#datePicker" class="form-control form-control-sm datetimepicker-input" />
                                    <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="amount">@lang('Amount')</label>
                                <input type="nummber" name="amount" min="0" placeholder="@lang('Amount')" class="form-control form-control-sm" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

{{-- extra css --}}
@push('css')
{{-- date picker --}}
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" />
@endpush

{{-- extra js --}}
@push('js')
{{-- date picker --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#datePicker').datetimepicker({
                format: "{{dataFormat()}}",
                date: moment(),
            });
        });
    </script>
@endpush