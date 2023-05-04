@extends('layouts.admin')
@section('title', __('Edit FDR'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">@lang('Edit FDR')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('fdr.index')}}">@lang("FDR List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Edit FDR')</li>
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
        <div class="col-md-12 col-sm-12">
            <form action="{{route('fdr.update', ['fdr' => $fdr->id])}}" method="post">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Card Title')</h4>
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
                                                @if($fdr->member_id == $member->id) selected @endif
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
                                    <input type="text" name="account" placeholder="@lang('A/C No')" value="{{$fdr->account}}" id="account" class="form-control form-control-sm @error('account') is-invalid @enderror " required/>
                                    @error('account')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">@lang('Mobile')</label>
                                    <input type="tel" name="mobile" placeholder="@lang('Mobile')" value="{{$fdr->mobile}}" id="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror "/>
                                    @error('mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fdr_amount">@lang('FDR Amount')*</label>
                                    <input type="number" name="fdr_amount" placeholder="@lang('FDR Amount')" value="{{$fdr->fdr_amount}}" id="fdr_amount" class="form-control form-control-sm @error('fdr_amount') is-invalid @enderror " required/>
                                    @error('fdr_amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="fdrtype_id">@lang('FDR Type')*</label>
                                    <select name="fdrtype_id" id="fdrtype_id" class="form-control form-control-sm @error('fdrtype_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a FDR Type')</option>
                                        @forelse ($fdrTypes as $fdrType)
                                            <option
                                                data-interest="{{$fdrType->interest_rate}}"
                                                value="{{$fdrType->id}}"
                                                @if($fdrType->id == $fdr->fdrtype_id) selected @endif
                                            >{{$fdrType->name}} ({{$fdrType->interest_rate}}%)</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('fdrtype_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
                                    <label for="return_interest">@lang('Return Interest')*</label>
                                    <input type="number" name="return_interest" placeholder="@lang('Return Interest')" value="{{$fdr->return_interest}}" id="return_interest" class="form-control form-control-sm @error('return_interest') is-invalid @enderror " required/>
                                    @error('return_interest')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="refer_member">@lang('Ref. Member')*</label>
                                    <select name="refer_member" id="refer_member" class="form-control form-control-sm @error('refer_member') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Refer Member')</option>
                                        @forelse ($members as $member)
                                            <option
                                                value="{{$member->id}}"
                                                @if($member->id == $fdr->refer_member) selected @endif
                                            >{{$member->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="refer_user">@lang('Ref. User')*</label>
                                    <select name="refer_user" id="refer_user" class="form-control form-control-sm @error('refer_user') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Refer User')</option>
                                        @forelse ($users as $user)
                                            <option
                                                value="{{$user->id}}"
                                                @if($user->id == $fdr->refer_user) selected @endif
                                            >{{$user->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="comment">@lang('Comment')</label>
                                    <textarea name="comment" id="comment" class="form-control form-control-sm @error('total_amount') is-invalid @enderror " cols="30" rows="4" placeholder="@lang('Comment')">{{$fdr->comment}}</textarea>
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
            date: "{{$fdr->date}}",
        });

        $('#startDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: "{{$fdr->start_date}}",
        });

        $('#expireDatePicker').datetimepicker({
            format: "{{dataFormat()}}",
            date: "{{$fdr->expire_date}}",
        });

        $('#member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Member')",
        });

        $('#refer_member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Refer Member')",
        });

        $('#refer_user').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Refer User')",
        });

        $('#fdrtype_id').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a FDR Type')",
        });

        $('#fdr_amount').on("input", function() {
           $('#fdrtype_id').val('').trigger('change');
        });

        $('#member').on("change", function() {
            let mobile = $(this).find(':selected').attr('data-mobile');
            let account = $(this).find(':selected').attr('data-account');
            $('#mobile').val(mobile);
            $('#account').val(account);
        });

        $('#member').trigger('change');

        $('#fdrtype_id').on("change", function() {
            let interest_rate = $(this).find(':selected').attr('data-interest');
            let fdr_amount = $('#fdr_amount').val();
            let return_interest = ((fdr_amount * interest_rate) / 100);
            $('#return_interest').val(return_interest);
        });

        $('#fdrtype_id').trigger('change');

    });
</script>
@endpush