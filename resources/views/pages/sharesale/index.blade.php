@extends('layouts.admin')
@section('title', __('Share Sale List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Share Sale List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Share Sale List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('shareSale-create')
                        <a href="javascript:void(0)" id="create-btn" data-href="{{route('share-sale.create')}}" class="btn btn-sm btn-success">@lang('Add New Share Sale')</a>
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
            <div class="card shadow">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang('Share Sale List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="sharesale_list" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr class="text-center bg-light">
                                <th>@lang('SL')</th>
                                <th>@lang('Vouchar No')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Share Type')</th>
                                <th>@lang('Member Name')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Comment')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>                        
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    {{-- add new share slae modal --}}
    <div class="modal fade bd-example-modal-lg" id="add-new-sale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{route('share-sale.store')}}" id="create-form" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title">{{__("Add New Share Sale")}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body overflow-auto" style="min-height: 40vh;" >
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="date">@lang('Date')*</label>
                                <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                    <input type="text" name="date" placeholder="@lang('Date')" data-toggle="joinDatePicker" id="date"  class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input" data-target="#joinDatePickerOne" required/>
                                    <div class="input-group-append" data-target="#joinDatePickerOne" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="member">@lang('Member')*</label>
                                    <select name="member_id" id="member" class="form-control form-control-sm @error('member_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Member')</option>
                                        @forelse ($members as $member)
                                            <option value="{{$member->id}}" >{{$member->name}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="vouchar_no">@lang('Vouchar No')</label>
                                <input type="text" name="vouchar_no" id="vouchar_no" placeholder="@lang('vouchar_no')" class="form-control form-control-sm" />
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="amount">@lang('Amount')*</label>
                                <input type="number" name="amount" id="amount" min="0" step="any" placeholder="@lang('Amount')" class="form-control form-control-sm" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="comment">@lang('Comment')</label>
                                <textarea name="comment" id="comment" class="form-control form-control-sm " cols="30" rows="2" placeholder="@lang('Comment')"></textarea>
                            </div>
                        </div>                   
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">@lang('Save')</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- extra css --}}
@push('css')
    {{-- data tables style --}}
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
    {{-- date picker --}}
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" />
    {{-- bootstrap select 2 --}}
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    {{-- bootstrap 4 select 2 theme --}}
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
{{-- extra js --}}
@push('js')
    {{-- DataTables  & Plugins --}}
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    {{-- date picker --}}
    <script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
    {{-- bootstrap select 2 --}}
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
@endpush
{{-- extra js for this page --}}
@push('js')
    <script>
        var table = null;
        $(function() {
            table = $("#sharesale_list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{route("share-sale.index")}}',
                columns: [
                    { data: 'id', orderSequence: ["desc"], className: 'text-center' },
                    { data: 'vouchar_no' },
                    { data: 'date' },
                    { data: 'share_type' },
                    { data: 'member.name', className:'text-left' },
                    { data: 'amount' },
                    { data: 'comment' },
                    { data: 'action', orderable:false,searchable:false },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                },
            });
        });

        $(document).ready(function(){

            $('#joinDatePickerOne').datetimepicker({
                format: "{{dataFormat()}}",
                date: moment(),
            });

            $('#member').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Member')",
            });

            $('#create-btn').click(function() {
                $('#add-new-sale').modal('show');
            });

            // save and create form
            $('#create-form').on('submit', function(evt) {
                evt.preventDefault();
                let action = $(this).attr('action');
                let data = Object.fromEntries(new FormData(evt.target).entries())
                $.ajax({
                    url: action,
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#create-form button[type="submit"]').html(LOADING_SPINNER);
                    },
                    success: function (data) {
                        if(data.success) {
                            $('#create-form button[type="submit"]').html("{{__('Save')}}");
                            Swal.fire({
                                icon: 'success',
                                title: 'Created',
                                text: data.message,
                            });
                            $('#create-form').trigger('reset');
                            $('#member').val(null).trigger('change');
                            table.ajax.reload(null, false);
                            $('#add-new-sale').modal('hide');
                        }                        
                    }
                });
            });

            // get edit form
            $(document).on('click', '.edit-btn', function () {
                let href = $(this).data('href');
                $('#view_modal').modal('show');
                $('#view_body').html(LOADING_SPINNER);
                $('#view_title').text('{{__("Edit Sale Share")}}');
                $.ajax({
                    url: href,
                    method: 'get', 
                    dataType: 'text',
                    success: function (data) {
                        $('#view_body').html(data);
                        $('#updateJoinDatePicker').datetimepicker({
                            format: "{{dataFormat()}}",
                            date: moment(),
                        });
                        
                        $('#update_member').select2({
                            theme: "bootstrap4",
                            allowClear: true,
                            placeholder: "@lang('Select a Member')",
                        });
                    },
                    error: function () {
                        $('#view_body').html(`<div class="alert alert-danger">Somethign went worng</div>`);
                    },
                });
            });

            // update form
            $(document).on('submit', '#update-share-sale', function (evt) {
                evt.preventDefault();
                let action = $(this).attr('action');                
                var data = Object.fromEntries(new FormData(evt.target).entries());
                $.ajax({
                    url: action,
                    data: data,
                    method: 'POST',
                    beforeSend: function() {
                        $(this).find('button[type="submit"]').html(LOADING_SPINNER);
                    },
                    success: function (data) {
                        if(data.success) {
                            $(this).find('button[type="submit"]').html("{{__('Save')}}");
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: data.message,
                            });
                            $('#view_modal').modal('hide');
                            table.ajax.reload(null, true);
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Something went worng!",
                        });
                    }
                });
            });

            // delete user
            $(document).on('click', '.delete_btn', function(){
                let href = $(this).data('href');
                Swal.fire({
                    title: 'Are you sure to Delete?',
                    text: "You won't be able to undo this. Will you proceed to delete all student related data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "@lang('Yes, delete it!')",
                    customClass: {
                        confirmButton: 'btn btn-primary btn-lg',
                        cancelButton: 'btn btn-danger btn-lg',
                        loader: 'custom-loader',
                    },
                    loaderHtml: LOADING_SPINNER,
                    preConfirm: () => {
                        Swal.showLoading();
                        return new Promise((resolve)=> {
                            let form = new FormData();
                            form.append('_token', $('meta[name="csrf_token"]').attr('content'));
                            form.append('_method', "DELETE");
                            let data = Object.fromEntries(form.entries())                        
                            let post_ajax = $.ajax({
                                url: href,
                                method: "DELETE",
                                data : data,
                                success: function(data){                                 
                                    if(data.success) {
                                        resolve({text:data.text, success: true});
                                        table.ajax.reload(null, true);
                                    }                                 
                                }
                            });
                            post_ajax.fail(function(xhr, textStatus){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Opps..!',
                                    text: textStatus,
                                    timer: 5000,
                                });
                            });
                        });
                    },
                }).then((result) => {
                    if (result.isConfirmed && result.value.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success..!',
                            text: result.value.text,
                            timer: 5000,
                        });     
                    };
                });
            });

        });

    </script>
@endpush