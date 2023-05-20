@extends('layouts.admin')
@section('title', __('Add New DPS'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Add New DPS')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Add New DPS')</li>
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
        <div class="col-md-12 col-sm-12">
            <form action="{{route('dps.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Add New DPS')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
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
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="member">@lang('Member')*</label>
                                    <select name="member_id" id="member" class="form-control form-control-sm @error('member_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Member')</option>
                                        @forelse ($members as $member)
                                            <option
                                                data-mobile="{{$member->mobile}}"
                                                data-account="{{$member->account}}"
                                                value="{{$member->id}}"
                                            >{{$member->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="account">@lang('A/C No')*</label>
                                    <input type="text" name="account" placeholder="@lang('A/C No')" value="{{old('account')}}" id="account" class="form-control form-control-sm @error('account') is-invalid @enderror " required/>
                                    @error('account')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">@lang('Mobile')</label>
                                    <input type="tel" name="mobile" placeholder="@lang('Mobile')" value="{{old('mobile')}}" id="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror "/>
                                    @error('mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="amount_per_installment">@lang('Amount Per Installment')*</label>
                                    <input type="number" name="amount_per_installment" placeholder="@lang('Amount Per Installment')" value="{{old('amount_per_installment')}}" id="amount_per_installment" class="form-control form-control-sm @error('amount_per_installment') is-invalid @enderror " required/>
                                    @error('amount_per_installment')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="number_of_installment">@lang('Number Of Installment')*</label>
                                    <input type="number" name="number_of_installment" placeholder="@lang('Number Of Installment')" value="{{old('number_of_installment')}}" id="number_of_installment" class="form-control form-control-sm @error('number_of_installment') is-invalid @enderror " required/>
                                    @error('number_of_installment')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dpstype_id">@lang('DPS Type')*</label>
                                    <select name="dpstype_id" id="dpstype_id" class="form-control form-control-sm @error('dpstype_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a DPS Type')</option>
                                        @forelse ($dpsTypes as $dpsType)
                                            <option data-interest="{{$dpsType->interest_rate}}" value="{{$dpsType->id}}">{{$dpsType->name}} ({{$dpsType->interest_rate}}%)</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('dpstype_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="start_date">@lang('Start Date')*</label>
                                    <div class="input-group date" id="startDatePicker" data-target-input="nearest">
                                        <input type="text" name="start_date" placeholder="@lang('Start Date')" id="start_date"  class="form-control form-control-sm @error('start_date') is-invalid @enderror datetimepicker-input" data-target="#startDatePicker" required/>
                                        <div class="input-group-append" data-target="#startDatePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('start_date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="expire_date">@lang('Expire Date')*</label>
                                    <div class="input-group date" id="expireDatePicker" data-target-input="nearest">
                                        <input type="text" name="expire_date" placeholder="@lang('Expire Date')" id="expire_date"  class="form-control form-control-sm @error('expire_date') is-invalid @enderror datetimepicker-input" data-target="#expireDatePicker" required/>
                                        <div class="input-group-append" data-target="#expireDatePicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('expire_date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fine_missing_dps">@lang('Fine Missing DPS')*</label>
                                    <input type="number" name="fine_missing_dps" min="0" step="any" placeholder="@lang('Fine Missing DPS')" value="{{old('fine_missing_dps')}}" id="fine_missing_dps" class="form-control form-control-sm @error('fine_missing_dps') is-invalid @enderror " required/>
                                    @error('fine_missing_dps')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="profit">@lang('Profit')*</label>
                                    <input type="number" name="profit" min="0" step="any" placeholder="@lang('Profit')" value="{{old('profit')}}" id="profit" class="form-control form-control-sm @error('profit') is-invalid @enderror " required/>
                                    @error('profit')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="total_amount">@lang('Total Amount')*</label>
                                    <input type="number" name="total_amount" min="0" step="any" placeholder="@lang('Total Amount')" value="{{old('total_amount')}}" id="total_amount" class="form-control form-control-sm @error('total_amount') is-invalid @enderror " required/>
                                    @error('total_amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="comment">@lang('Comment')</label>
                                    <textarea name="comment" id="comment" class="form-control form-control-sm @error('total_amount') is-invalid @enderror " cols="30" rows="4" placeholder="@lang('Comment')">{{old('comment')}}</textarea>
                                    @error('comment')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
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
            date: moment(),
        });

        $('#startDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: moment(),
        });

        $('#expireDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: moment(),
        });

        $('#member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Member')",
        });

        $('#dpstype_id').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a DPS Type')",
        });

        $('#member').on("change", function() {
            let mobile = $(this).find(':selected').attr('data-mobile');
            let account = $(this).find(':selected').attr('data-account');
            $('#mobile').val(mobile);
            $('#account').val(account);
        });

        $('#dpstype_id').on("change", function() {
            let interest_rate = $(this).find(':selected').attr('data-interest');
            let amount_per_installment = $('#amount_per_installment').val();
            let number_of_installment = $('#number_of_installment').val()
            let total_amount = (amount_per_installment || 1) * (number_of_installment || 1);
            let profit = ((total_amount * interest_rate) / 100);
            $('#profit').val(profit);
            $('#total_amount').val(total_amount+profit);
        });


    });
</script>
@endpush