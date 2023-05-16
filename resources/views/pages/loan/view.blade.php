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
            {{-- loan details --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Loan Details')</h4>
                </div>
                <div class="card-body overflow-auto">
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
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- reference information --}}
            <div class="card collapsed-card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Reference Information')</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>@lang('Ref: User Name'):</b> {{$loan->refUser->name}}
                                </td>
                                <td>
                                    <b>@lang('Ref: Member Name'):</b> {{$loan->refMember->name}}
                                </td>
                                <td>
                                    <b>@lang('Guarantor Name'):</b> {{optional($extra_info)->guarantor_name}}
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <b>@lang('Guarantor Father Name'):</b> {{optional($extra_info)->guarantor_father}}
                                </td>
                                <td>
                                    <b>@lang('Guarantor Relation'):</b> {{optional($extra_info)->guarantor_relation}}
                                </td>
                                <td>
                                    <b>@lang('Guarantor Phone'):</b> {{optional($extra_info)->guarantor_phone}}
                                </td>                                
                            <tr>
                                <td>
                                    <b>@lang('Bank Account Number'):</b> {{optional($extra_info)->bank_account_number}}
                                </td>
                                <td>
                                    <b>@lang('Check Number'):</b> {{optional($extra_info)->check_number}}
                                </td>
                                <td>&nbsp;</td>                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- comment iformation --}}
            @if($loan->comment)
            <div class="card collapsed-card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Comment')</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{$loan->comment ?? "N/A"}}
                </div>
            </div>
            @endif

            {{-- loand documents --}}
            @if(optional($extra_info)->file_upload && optional($extra_info)->security_docs)
            <div class="card collapsed-card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Documents')</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            @if(optional($extra_info)->file_upload)
                                <?php
                                    $file_info = pathinfo(optional($extra_info)->file_upload);
                                ?>
                                @if($file_info['extension'] == 'pdf')
                                    <a class="btn btn-primary btn-sm" href="{{asset('storage/loan/'.optional($extra_info)->file_upload . '')}}" target="_blank" rel="noopener noreferrer">Show File Upload Pdf</a>
                                @else 
                                    <img src="{{asset('storage/loan/'.optional($extra_info)->file_upload . '')}}" class="img-thumbnail" alt="File Upload">
                                @endif
                            @else 
                                N/A
                            @endif
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="border p-3 mt-3">
                                @if(optional($extra_info)->security_docs)
                                    <?php
                                        $file_info = pathinfo(optional($extra_info)->security_docs);
                                    ?>
                                    @if($file_info['extension'] == 'pdf')
                                        <a class="btn btn-primary btn-sm" href="{{asset('storage/loan/'.optional($extra_info)->security_docs . '')}}" target="_blank" rel="noopener noreferrer">Show Security Docs Pdf</a>
                                    @else 
                                        <img src="{{asset('storage/loan/'.optional($extra_info)->security_docs . '')}}" class="img-thumbnail" alt="Security Docs">
                                    @endif
                                @else 
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- loan details --}}
            <div class="card expanded-card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Installment List')</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
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
                        @forelse ($loan->installmentable as $installment)
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