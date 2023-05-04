@extends('layouts.admin')
@section('title', __('Add New Savings'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Add New Savings')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Add New Savings')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('saving-index')
                        <a href="{{route('savings.index')}}" class="btn btn-sm btn-success">@lang('Savings List')</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <form action="{{route('savings.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Add New Savings')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="vch_no">@lang('Vch. No')</label>
                                    <input type="text" name="voucher_no" placeholder="@lang('Vch. No')" value="{{old('voucher_no')}}" id="vch_no" class="form-control form-control-sm @error('voucher_no') is-invalid @enderror ">
                                    @error('voucher_no')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
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
                            <div class="col-md-6 col-sm-12">
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
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="amount">@lang('Amount')</label>
                                    <input type="number" name="amount" placeholder="@lang('Amount')" value="{{old('amount')}}" id="amount" class="form-control form-control-sm @error('amount') is-invalid @enderror ">
                                    @error('amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
        <div class="col-md-4 col-sm-12" id="member_detail">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Member Details')</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
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
<script>
    $(document).ready(function() {
        $('#joinDatePickerOne').datetimepicker({
            format: "{{dataFormat()}}",
            date: moment(),
        });

        $('#member').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Member')",
        });

        $("#member").on('change', function() {
            var memberId = $(this).val();
            $('#member_detail').html(LOADING_SPINNER);
            if(!memberId) {
                $.get("{{route("savings.create")}}?member="+memberId+"", function(res, status) {
                    $('#member_detail').html(res);
                });
            }else {
                $('#member_detail').html('');
            }

        })
    });
</script>
@endpush