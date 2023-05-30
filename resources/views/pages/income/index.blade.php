@extends('layouts.admin')
@section('title', __('Income List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Income List')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Income List')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('income-create')
                        <button type="button" id="create-button" class="btn btn-sm btn-success">@lang('Add New Income')</button>
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
                    <h4 class="card-title">@lang('Income List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="income_list" class="table table-sm table-striped table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Voucher No')</th>
                                <th class="text-left">@lang('Income Category')</th>
                                <th>@lang('Amount')</th>
                                <th class="text-left">@lang('Note')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('income-create')
        {{-- transaction create --}}
        <div class="modal fade" id="store-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <form action="{{ route('income.store') }}" method="post" id="income-store">
                @csrf
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title">@lang('Add New Income')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="voucher_no_">@lang('Voucher No')</label>
                                        <input type="text" name="voucher_no" placeholder="@lang('Voucher No')"
                                            value="{{ old('voucher_no') }}" id="voucher_no_"
                                            class="form-control form-control-sm @error('voucher_no') is-invalid @enderror " />
                                        @error('voucher_no')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="joinDate_">@lang('Date')*</label>
                                        <div class="input-group date" id="joinDatePickerUpdate" data-target-input="nearest">
                                            <input type="text" name="date" placeholder="@lang('Date')"
                                                data-toggle="joinDatePicker" id="joinDate_"
                                                class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input"
                                                data-target="#joinDatePickerUpdate" required />
                                            <div class="input-group-append" data-target="#joinDatePickerUpdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('date')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="bankAccount_">@lang('Income Category')*</label>
                                        <select name="incomecategory_id" id="incomecategory_"
                                            class="form-control form-control-sm @error('incomecategory_id') is-invalid @enderror"
                                            required />
                                        <option value="" hidden>@lang('Select a Income Category')</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                        </select>
                                        @error('incomecategory_id')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                        <p class="m-0 p-0 text-danger"><span id="show-bank-balance"></span></p>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="amount_">@lang('Amount')*</label>
                                        <input type="number" name="amount" placeholder="@lang('Amount')"
                                            value="{{ old('amount') }}" id="amount_"
                                            class="form-control form-control-sm @error('amount') is-invalid @enderror "
                                            required />
                                        @error('amount')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note_">@lang('Note')</label>
                                    <textarea name="note" id="note_" class="form-control form-control-sm @error('note') is-invalid @enderror "
                                        cols="30" rows="2" placeholder="@lang('Note')">{{ old('note') }}</textarea>
                                    @error('Note')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endcan

    @can('income-update')
        {{-- transaction create --}}
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <form action="" method="post" id="income-update">
                @csrf @method('PUT')
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header  bg-success">
                            <h5 class="modal-title">@lang('Edit Income')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="voucher_no">@lang('Voucher No')</label>
                                        <input type="text" name="voucher_no" placeholder="@lang('Voucher No')" readonly
                                            value="{{ old('voucher_no') }}" id="voucher_no"
                                            class="form-control form-control-sm @error('voucher_no') is-invalid @enderror " />
                                        @error('voucher_no')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="joinDate">@lang('Date')*</label>
                                        <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                            <input type="text" name="date" placeholder="@lang('Date')"
                                                data-toggle="joinDatePicker" id="joinDate"
                                                class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input"
                                                data-target="#joinDatePickerOne" required />
                                            <div class="input-group-append" data-target="#joinDatePickerOne"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('date')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="incomecategory_">@lang('Income Category')*</label>
                                        <select name="incomecategory_id" id="incomecategory_"
                                            class="form-control form-control-sm @error('incomecategory_id') is-invalid @enderror"
                                            required />
                                        <option value="" hidden>@lang('Select a Income Category')</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                        </select>
                                        @error('incomecategory_id')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                        <p class="m-0 p-0 text-danger"><span id="show-bank-balance"></span></p>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="amount">@lang('Amount')*</label>
                                        <input type="number" name="amount" placeholder="@lang('Amount')"
                                            value="{{ old('amount') }}" id="amount"
                                            class="form-control form-control-sm @error('amount') is-invalid @enderror "
                                            required />
                                        @error('amount')
                                            <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note">@lang('Note')</label>
                                    <textarea name="note" id="note" class="form-control form-control-sm @error('note') is-invalid @enderror "
                                        cols="30" rows="2" placeholder="@lang('Note')">{{ old('note') }}</textarea>
                                    @error('Note')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endcan

    {{-- delete form --}}
    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
@endsection

{{-- extra css --}}
@push('css')
    {{-- data tables style --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- nice selecte --}}
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"
        crossorigin="anonymous" />
    {{-- date picker --}}
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"
        crossorigin="anonymous" />
    {{-- bootstrap select 2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    {{-- bootstrap 4 select 2 theme --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" />
@endpush

{{-- extra js --}}
@push('js')
    {{-- DataTables  & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- date picker --}}
    <script src="{{ asset('plugins/moment/moment.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"
        crossorigin="anonymous"></script>
    {{-- bootstrap select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    {{-- sweet alert --}}
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
{{-- extra js for this page --}}
@push('js')
    <script>
        var table = null;
        $(function() {
            table = $("#income_list").DataTable({
                "columnDefs": [{
                    "targets": -1,
                    "searchable": false,
                    "orderable": false,
                }],
                processing: true,
                serverSide: true,
                ajax: '{{ route('income.index') }}',
                columns: [{
                        data: 'id',
                        orderSequence: ["desc"],
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'voucher_no'
                    },
                    {
                        data: 'income_category.name',
                        className : 'text-left',
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'note',
                        className : 'text-left',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    "searchPlaceholder": "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {

            $("#create-button").click(function() {
                $('#store-modal').modal('show');
            });

            $('#joinDatePickerOne').datetimepicker({
                format: "{{ dataFormat() }}",
                date: moment(),
            });

            $('#joinDatePickerUpdate').datetimepicker({
                format: "{{ dataFormat() }}",
                date: moment(),
            });

            $('#incomecategory').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Income Category')",
            });

            $('#incomecategory_').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Income Category')",
            });

            @can('income-update')
            $(document).on("click", ".edit_btn", function() {
                let href = $(this).data('href');
                $('#update-modal').modal('show');
                var tr = $(this).closest('tr');
                var row = table.row(tr).data();
                $('#income-update input[name="date"]').val(row.date);
                $('#income-update input[name="voucher_no"]').val(row.voucher_no);
                $('#income-update select[name="incomecategory_id"]').val(row.incomecategory_id).trigger(
                'change');
                $('#income-update input[name="amount"]').val(row.amount);                
                $('#income-update textarea[name="note"]').val(row.note);
                $('#income-update').attr("action", href);
            });

            $(document).on('submit', '#income-update', function(evt) {
                evt.preventDefault();
                var data = Object.fromEntries(new FormData(evt.target).entries());
                let action = $(this).attr('action');
                $.ajax({
                    url: action,
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#income-update button[type="submit"]').html(
                            LOADING_SPINNER);
                    },
                    success: function(data) {                        
                        if (data.success) {
                            $('#income-update button[type="submit"]').html(
                                "{{ __('Save') }}");
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: data.message,
                            });
                            $('#income-update').trigger('reset');                          
                            table.ajax.reload(null, false);
                            $('#update-modal').modal('hide');
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'opps!',
                            text: "Something went worng!",
                        });
                    },
                });
            });
            @endcan

            @can('income-create')
                $('#income-store').on('submit', function(evt) {
                    evt.preventDefault();
                    let action = $(this).attr('action');
                    let data = Object.fromEntries(new FormData(evt.target).entries())
                    $.ajax({
                        url: action,
                        method: 'post',
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $('#income-store button[type="submit"]').html(
                                LOADING_SPINNER);
                        },
                        success: function(data) {
                            if (data.success) {
                                $('#income-store button[type="submit"]').html(
                                    "{{ __('Save') }}");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Created',
                                    text: data.message,
                                });
                                $('#income-store').trigger('reset');
                                $('#incomecategory').val(null).trigger('change');
                                table.ajax.reload(null, false);
                                $('#store-modal').modal('hide');
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'opps!',
                                text: "Something went worng!",
                            });
                        },
                    });
                });
            @endcan

            
            // delete user
            $(document).on('click', '.delete_btn', function(){
                let href = $(this).data('href');
                Swal.fire({
                    title: 'Are you sure to Delete?',
                    text: "You won't be able to undo this. Will you proceed to delete all related data?",
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
