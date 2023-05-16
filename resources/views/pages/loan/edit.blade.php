@extends('layouts.admin')
@section('title', __('Edit Loan'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Edit Loan')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('loan.index')}}">@lang("Loan List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Edit Loan')</li>
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
        <div class="col-md-12 col-sm-12">
            <form action="{{route('loan.update', ['loan' => $loan->id])}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Edit Loan')</h4>
                    </div>
                </div>
                {{-- member information --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Member Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="joinDate">@lang('Date')*</label>
                                    <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                        <input type="text" name="date" placeholder="@lang('Date')" data-toggle="joinDatePicker" id="joinDate"  class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input" data-target="#joinDatePickerOne" required/>
                                        <div class="input-group-append" data-target="#joinDatePickerOne" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="member">@lang('Member')*</label>
                                    <select name="member_id" id="member" class="form-control form-control-sm @error('member_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Member')</option>
                                        @forelse ($members as $member)
                                            <option
                                                data-mobile="{{$member->mobile}}"
                                                data-account="{{$member->account}}"
                                                value="{{$member->id}}"
                                                @if($loan->member_id == $member->id) selected @endif
                                            >{{$member->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">@lang('Mobile')*</label>
                                    <input type="tel" name="mobile" placeholder="@lang('Mobile')" value="{{old('mobile')}}" id="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror " required/>
                                    @error('mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="account">@lang('Account')*</label>
                                    <input type="text" name="account" placeholder="@lang('Account')" value="{{old('account')}}" id="account" class="form-control form-control-sm @error('account') is-invalid @enderror " required/>
                                    @error('account')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- loan information --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Loan Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="loantype_id">@lang('Loan Type')*</label>
                                    <select name="loantype_id" id="loantype_id" class="form-control form-control-sm @error('loantype_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Loan Type')</option>
                                        @forelse ($loantypes as $loantype)
                                            <option
                                                data-interest="{{$loantype->interest_rate}}"
                                                value="{{$loantype->id}}"
                                                @if($loan->loantype_id == $loantype->id) selected @endif
                                            >{{$loantype->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('loantype_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="amount">@lang('Loan Amount')*</label>
                                    <input type="number" min='0' name="amount" placeholder="@lang('Loan Amount')" value="{{$loan->amount}}" id="amount" class="form-control form-control-sm @error('amount') is-invalid @enderror " required />
                                    @error('amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="interest">@lang('Loan Interest')%*</label>
                                    <input type="number" min='0' name="interest" placeholder="@lang('Loan Interest')" value="{{$loan->interest}}" id="interest" class="form-control form-control-sm @error('interest') is-invalid @enderror " required />
                                    @error('interest')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="total_amount_payable">@lang('Total Amount Payable')*</label>
                                    <input type="number" min='0' name="total_amount_payable" placeholder="@lang('Total Amount Payable')" value="{{$loan->total_amount_payable}}" id="total_amount_payable" class="form-control form-control-sm @error('total_amount_payable') is-invalid @enderror " required />
                                    @error('total_amount_payable')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="installment_number">@lang('Installment Number')*</label>
                                    <input type="number" min='0' name="installment_number" placeholder="@lang('Installment Number')" value="{{$loan->installment_number}}" id="installment_number" class="form-control form-control-sm @error('installment_number') is-invalid @enderror " required />
                                    @error('installment_number')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="installment_amount">@lang('Installment Amount')*</label>
                                    <input type="number" min='0' name="installment_amount" placeholder="@lang('Installment Amount')" value="{{$loan->installment_amount}}" id="installment_amount" class="form-control form-control-sm @error('installment_amount') is-invalid @enderror " required />
                                    @error('installment_amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="insurence_amount">@lang('Insurence Amount')*</label>
                                    <input type="number" min='0' name="insurence_amount" placeholder="@lang('Insurence Amount')" value="{{$loan->insurence_amount}}" id="insurence_amount" class="form-control form-control-sm @error('insurence_amount') is-invalid @enderror " required />
                                    @error('insurence_amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="loan_fee">@lang('Loan Fee')*</label>
                                    <input type="number" min='0' name="loan_fee" placeholder="@lang('Loan Fee')" value="{{$loan->loan_fee}}" id="loan_fee" class="form-control form-control-sm @error('loan_fee') is-invalid @enderror " required />
                                    @error('loan_fee')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="loanStartDate">@lang('Loan Start Date')*</label>
                                    <div class="input-group date" id="loanStartDatePicker" data-target-input="nearest">
                                        <input type="text" name="loan_start_date" placeholder="@lang('Loan Start Date')" data-toggle="loanStartDatePicker" id="loanStartDate"  class="form-control form-control-sm @error('loan_start_date') is-invalid @enderror datetimepicker-input" data-target="#loanStartDatePicker" required />
                                        <div class="input-group-append" data-target="#loanStartDatePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('loan_start_date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="loanEndDate">@lang('Loan End Date')*</label>
                                    <div class="input-group date" id="loanEndDatePicker" data-target-input="nearest">
                                        <input type="text" name="loan_end_date" placeholder="@lang('Loan End Date')" data-toggle="loanEndDatePicker" id="loanEndDate"  class="form-control form-control-sm @error('loan_end_date') is-invalid @enderror datetimepicker-input" data-target="#loanEndDatePicker" required />
                                        <div class="input-group-append" data-target="#loanEndDatePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('loan_end_date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Reference Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="ref_user_id">@lang('Ref: User Name')*</label>
                                    <select name="ref_user_id" id="ref_user_id" class="form-control form-control-sm @error('ref_user_id') is-invalid @enderror" required />
                                        <option value="" hidden>@lang('Select a User Name')</option>
                                        @forelse ($users as $user)
                                            <option value="{{$user->id}}" @if($loan->refer_user_id == $user->id) selected @endif>{{$user->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('ref_user_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="ref_member_id">@lang('Ref: Member Name')*</label>
                                    <select name="ref_member_id" id="ref_member_id" class="form-control form-control-sm @error('ref_member_id') is-invalid @enderror" required />
                                        <option value="" hidden>@lang('Select a Member')</option>
                                        @forelse ($members as $member)
                                            <option
                                                value="{{$member->id}}"
                                                @if($loan->refer_member_id == $member->id) selected @endif
                                            >{{$member->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('ref_member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="guarantor_name">@lang('Guarantor Name')</label>
                                    <input type="text" name="guarantor_name" placeholder="@lang('Guarantor Name')" value="{{optional($extra_info)->guarantor_name}}" id="guarantor_name" class="form-control form-control-sm @error('guarantor_name') is-invalid @enderror "/>
                                    @error('guarantor_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="guarantor_father">@lang('Guarantor Father Name')</label>
                                    <input type="text" name="guarantor_father" placeholder="@lang('Guarantor Father Name')" value="{{optional($extra_info)->guarantor_father}}" id="guarantor_father" class="form-control form-control-sm @error('guarantor_father') is-invalid @enderror "/>
                                    @error('guarantor_father')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="guarantor_relation">@lang('Guarantor Relation')</label>
                                    <input type="text" name="guarantor_relation" placeholder="@lang('Guarantor Relation')" value="{{optional($extra_info)->guarantor_relation}}" id="guarantor_relation" class="form-control form-control-sm @error('guarantor_relation') is-invalid @enderror "/>
                                    @error('guarantor_relation')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="guarantor_phone">@lang('Guarantor Phone')</label>
                                    <input type="text" name="guarantor_phone" placeholder="@lang('Guarantor Phone')" value="{{optional($extra_info)->guarantor_phone}}" id="guarantor_phone" class="form-control form-control-sm @error('guarantor_phone') is-invalid @enderror "/>
                                    @error('guarantor_phone')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="bank_account_number">@lang('Bank Account Number')</label>
                                    <input type="text" name="bank_account_number" placeholder="@lang('Banck Account Number')" value="{{optional($extra_info)->bank_account_number}}" id="bank_account_number" class="form-control form-control-sm @error('bank_account_number') is-invalid @enderror "/>
                                    @error('bank_account_number')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="check_number">@lang('Check Number')</label>
                                    <input type="text" name="check_number" placeholder="@lang('Check Number')" value="{{optional($extra_info)->check_number}}" id="check_number" class="form-control form-control-sm @error('check_number') is-invalid @enderror "/>
                                    @error('check_number')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Documents')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="file_upload">@lang('File Upload')</label>
                                <div class="custom-file">
                                    <input type="file" name="file_upload" accept="image/*,.pdf" class="custom-file-input form-control-sm @error('file_upload') is-invalid @enderror" id="file_upload" />
                                    <label class="custom-file-label" for="file_upload">@lang('File Upload')...</label>
                                    @error('file_upload')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="security_docs">@lang('Security Docs')</label>
                                <div class="custom-file">
                                    <input type="file" name="security_docs" accept="image/*,.pdf" class="custom-file-input form-control-sm @error('security_docs') is-invalid @enderror" id="security_docs" />
                                    <label class="custom-file-label" for="security_docs">@lang('Security Docs')...</label>
                                    @error('security_docs')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="comment">@lang('Comment')</label>
                            <textarea name="comment" id="comment" cols="30" rows="4" class="form-control" placeholder="@lang('Comment')">{{$loan->comment}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- extra css --}}
@push('css')
{{-- date picker --}}
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" />
{{-- bootstrap select 2 --}}
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
{{-- bootstrap 4 select 2 theme --}}
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

{{-- extra js --}}
@push('js')
{{-- date picker --}}
<script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
 {{-- bootstrap select 2 --}}
 <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
@endpush

@push("js")
<script type="text/javascript">
    $(document).ready(function() {

        $('#joinDatePickerOne').datetimepicker({
            format: "{{dataFormat()}}",
            date: "{{printDateFormat($loan->date)}}",
        });

        $('#loanStartDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: "{{printDateFormat($loan->loan_start_date)}}",
        });

        $('#loanEndDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: "{{printDateFormat($loan->loan_end_date)}}",
        });

        $('#member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Member')",
        });

        $('#ref_user_id').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Ref. User')",
        });

        $('#ref_member_id').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Ref. Member')",
        });

        $('#loantype_id').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Loan Type')",
        });       

        $('#loantype_id').on("change", function() {
            let interest_rate = $(this).find(':selected').attr('data-interest');
            $('#interest').val(interest_rate);
        });

        $('#amount').on('input', function () {
            let amount = $(this).val();
            let interest = $('#interest').val();
            let interest_amount = (amount * interest) / 100;
            $('#total_amount_payable').val(+amount + +interest_amount);
        });

        $('#member').on("change", function() {
            let mobile = $(this).find(':selected').attr('data-mobile');
            let account = $(this).find(':selected').attr('data-account');
            $('#mobile').val(mobile);
            $('#account').val(account);
        });

        /**
         * file select and show file name in label text
         */
        $(document).on('change', '.custom-file-input', function(e) {
            var fileName = e.target.files[0].name;
            var parent = $(this).parent();
            parent.find('label').html(fileName);
        });
        // installment_number
        // installment_amount
        $(document).on('input', '#installment_number', function() {
            let total_amount_payable = $('#total_amount_payable').val();
            let total_installment = $('#installment_number').val();
            let per_installment = (total_amount_payable / total_installment) || 0;
            $("#installment_amount").val(Math.ceil(per_installment));
        });

        $(document).on('input', '#installment_amount', function() {
            let total_amount_payable = $('#total_amount_payable').val();
            let installment_amount = $('#installment_amount').val();
            let per_installment = (total_amount_payable / installment_amount) || 0;
            $("#installment_number").val(Math.ceil(per_installment));
        });

        $('#member').trigger('change');
        $('#ref_user_id').trigger('change');
        $('#ref_member_id').trigger('change');
        $('#loantype_id').trigger('change');

    });
</script>
@endpush