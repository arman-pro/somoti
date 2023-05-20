@extends('layouts.admin')

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Dashboard')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">@lang('Dashboard')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Members')</span>
                    <span class="info-box-number">
                        {{ $memberCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Savings')</span>
                    <span class="info-box-number">
                        {{ $savingCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total DPS')</span>
                    <span class="info-box-number">
                        {{ $dpsCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total FDR')</span>
                    <span class="info-box-number">
                        {{ $fdfCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fas fa-donate"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Loan')</span>
                    <span class="info-box-number">
                        {{ $loanCount }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-balance-scale"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Share')</span>
                    <span class="info-box-number">
                        0
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Insurence')</span>
                    <span class="info-box-number">
                        0
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fas fa-stamp"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('Total Withdraw')</span>
                    <span class="info-box-number">
                        0
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                <h5 class="description-header">BDT {{ $loanAmount }}</h5>
                                <span class="description-text">@lang('TOTAL LOAN AMOUNT')</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                <h5 class="description-header">BDT {{ $savingsAmount }}</h5>
                                <span class="description-text">@lang('TOTAL SAVINGS AMOUNT')</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                <h5 class="description-header">BDT {{ $dpsAmount }}</h5>
                                <span class="description-text">@lang('TOTAL DPS AMOUNT')</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i></span>
                                <h5 class="description-header">BDT {{ $fdrAmount }}</h5>
                                <span class="description-text">@lang('TOTAL FDR AMOUNT')</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header bg-success border-transparent">
                    <h3 class="card-title">@lang('Latest Members')</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>@lang('Join Date')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Member No')</th>
                                    <th>@lang('Group')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestMembers as $member)
                                    <tr>
                                        <td>{{ printDateFormat($member->join_date) }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->member_no }}</td>
                                        <td>{{ $member->group->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">@lang('No Data Found!')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="{{ route('member.create') }}" class="btn btn-sm btn-info float-left">@lang('Add New Member')</a>
                    <a href="{{ route('member.index') }}"
                        class="btn btn-sm btn-secondary float-right">@lang('Member List')</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Circle Chart')</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div>
                        </div>                       
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-danger"></i> @lang('Loan')</li>
                                <li><i class="far fa-circle text-success"></i> @lang('Savings')</li>
                                <li><i class="far fa-circle text-warning"></i> @lang('DPS')</li>
                                <li><i class="far fa-circle text-info"></i> @lang('FDR')</li>
                            </ul>
                        </div>                      
                    </div>                    
                </div>               
                <div class="card-footer">
                    @lang('Total Finance Chart')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
@endpush
