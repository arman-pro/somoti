@extends('layouts.admin')
@section('title', __('Saving Withdraw'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Saving Withdraw')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Saving Withdraw')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <form action="{{route('withdraw.saving.store')}}" id="saving-form" method="post">
                @csrf
                <div class="card shadow">
                    <div class="card-header bg-success">
                        <h4 class="card-title">@lang('Saving Withdraw')</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date">Date*</label>
                            <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                <input type="text" name="date" placeholder="@lang('Date')" data-toggle="joinDatePicker" id="date"  class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input" data-target="#joinDatePickerOne" required/>
                                <div class="input-group-append" data-target="#joinDatePickerOne" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="member">@lang('Member')*</label>
                                <select name="member_id" id="member" class="form-control form-control-sm @error('member_id') is-invalid @enderror" required/>
                                    <option value="" hidden>@lang('Select a Member')</option>
                                    @forelse ($members as $member)
                                        <option value="{{$member->id}}" >{{$member->name}}</option>
                                    @empty
                                    @endforelse
                            </select>
                            @error('member_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">@lang('Amount')*</label>
                            <input type="number" name="amount" id="amount" min="0" step="any" placeholder="@lang('Amount')" class="form-control form-control-sm @error('amount') is-invalid @enderror" required />
                            @error('amount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                        </div>
                        <div class="form-group">
                            <label for="comment">@lang('Comment')</label>
                            <textarea name="comment" id="comment" cols="30" rows="2" class="form-control" placeholder="@lang('Comment')"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-12" id="member_detail">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang('Member Details')</h4>
                </div>
                <div class="card-body"></div>
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
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush

{{-- extra js --}}
@push('js')
    {{-- date picker --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
    {{-- bootstrap select 2 --}}
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    {{-- seet alert --}}
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>   
@endpush

{{-- extra js --}}
@push('js')
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

        $("#member").on('change', function () {
            var memberId = $(this).val();
            $('#member_detail').html(LOADING_SPINNER);
            if(memberId) {
                $.get("{{route("member.details")}}?member="+memberId+"", function(res, status) {
                    $('#member_detail').html(res);
                });
            }else {
                $('#member_detail').html('');
            }

        });

        $('#saving-form').on('submit', function(evt) {
            evt.preventDefault();
            let data = Object.fromEntries(new FormData(evt.target).entries());
            let action = $(this).attr('action');
            $.ajax({
                url: action,
                data: data,
                method: 'POST',
                dataType: 'json',
                beforSend: function () {
                    $('#saving-form button[type="submit"]').html(LOADING_SPINNER);
                },
                success: function (data) {
                    if(data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                        });
                        $('#saving-form').trigger('reset');
                        $('#member').val('').trigger('change');
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Wrong!',
                        text: 'Something went worng!',
                    });
                },
            });
        });
    });
</script>
@endpush