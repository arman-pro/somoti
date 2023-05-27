@extends('layouts.admin')
@section('title', __('Transaction List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Transaction List')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Transaction List')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @can('bank-transaction-add')
                    <div class="col-sm-12">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addNewTransaction"
                            class="btn btn-sm btn-success">@lang('Add New Transaction')</a>
                    </div>
                @endcan
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
                    <h4 class="card-title">@lang('Transaction List')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm" id="transaction_lists">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Bank Account')</th>
                                <th>@lang('Branch')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Transaction Type')</th>
                                <th>@lang('Note')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('bank-transaction-add')
        {{-- transaction create --}}
        <div class="modal fade" id="addNewTransaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <form action="{{ route('bank-account.transaction.store') }}" method="post" id="add-new-transaction">
                @csrf
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('Add New Transaction')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-row">
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
                                        <label for="bankAccount">@lang('Bank Account')*</label>
                                        <select name="bank_account" id="bankAccount"
                                            class="form-control form-control-sm @error('bank_account') is-invalid @enderror"
                                            required />
                                        <option value="" hidden>@lang('Select a Bank Account')</option>
                                        @forelse ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}">{{ $bankAccount->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                        </select>
                                        @error('bank_account')
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
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="">@lang('Transaction Type')</label> <br />
                                        <div class="form-check-inline icheck-primary icheck-inline">
                                            <input type="radio" name="transaction_type" id="deposit" value="deposit" />
                                            <label for="deposit">@lang('Deposit')</label>
                                        </div>
                                        <div class="form-check-inline icheck-primary icheck-inline">
                                            <input type="radio" name="transaction_type" value="withdraw" id="withdraw" />
                                            <label for="withdraw">@lang('Withdraw')</label>
                                        </div>
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

    @can('bank-transaction-edit')
    {{-- edit form --}}
    <div class="modal fade" id="editTransaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <form action="" method="post" id="edit-transaction">
            @csrf @method('PUT')
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Edit Transaction')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="date">@lang('Date')*</label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" name="date" placeholder="@lang('Date')"
                                            class="form-control form-control-sm @error('date') is-invalid @enderror datetimepicker-input"
                                            data-target="#datetimepicker1" required />
                                        <div class="input-group-append" data-target="#datetimepicker1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('date')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="bankAccountEdit">@lang('Bank Account')*</label>
                                    <select name="bank_account" id="bankAccountEdit"
                                        class="form-control form-control-sm @error('bank_account') is-invalid @enderror"
                                        required />
                                    <option value="" hidden>@lang('Select a Bank Account')</option>
                                    @forelse ($bankAccounts as $bankAccount)
                                        <option value="{{ $bankAccount->id }}">{{ $bankAccount->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                    </select>
                                    @error('bank_account')
                                        <p class="m-0 text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                    <p class="m-0 p-0 text-danger"><span id="show-bank-balance-edit"></span></p>
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
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="">@lang('Transaction Type')</label> <br />
                                    <div class="form-check-inline icheck-primary icheck-inline">
                                        <input type="radio" name="transaction_type" id="deposit" value="deposit" />
                                        <label for="deposit">@lang('Deposit')</label>
                                    </div>
                                    <div class="form-check-inline icheck-primary icheck-inline">
                                        <input type="radio" name="transaction_type" value="withdraw" id="withdraw" />
                                        <label for="withdraw">@lang('Withdraw')</label>
                                    </div>
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

@push('js')
    <script>
        var table = null;
        $(function() {
            table = $("#transaction_lists").DataTable({
                "columnDefs": [{
                    "targets": -1,
                    "searchable": false,
                    "orderable": false,
                }],
                processing: true,
                serverSide: true,
                ajax: '{{ route('bank-account.transaction') }}',
                columns: [{
                        data: 'id',
                        orderSequence: ["desc"],
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'bank.name'
                    },
                    {
                        data: 'bank.branch.name'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'transaction_type'
                    },
                    {
                        data: 'note'
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
            $('#joinDatePickerOne').datetimepicker({
                format: "{{ dataFormat() }}",
                date: moment(),
            });

            $('#datetimepicker1').datetimepicker({
                format: "{{ dataFormat() }}",
                date: moment(),
            });

            $('#bankAccount').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Bank Account')",
            });

            $("#bankAccount").change(function() {
                $('#show-bank-balance').text(null);
                let bankAccount = $(this).val();
                $.ajax({
                    data: {
                        bank: bankAccount
                    },
                    url: "{{ route('bank-account.get-balance') }}",
                    method: 'GET',
                    success: function(data) {
                        $('#show-bank-balance').text("Balance: " + data);
                    },
                });
            });

            $("#bankAccountEdit").change(function() {
                $('#show-bank-balance-edit').text(null);
                let bankAccount = $(this).val();
                $.ajax({
                    data: {
                        bank: bankAccount
                    },
                    url: "{{ route('bank-account.get-balance') }}",
                    method: 'GET',
                    success: function(data) {
                        $('#show-bank-balance-edit').text("Balance: " + data);
                    },
                });
            });

            @can('bank-transaction-edit')
            $(document).on("click", ".edit_btn", function() {
                let href = $(this).data('href');
                $('#editTransaction').modal('show');
                var tr = $(this).closest('tr');
                var row = table.row(tr).data();
                $('#edit-transaction input[name="date"]').val(row.date);
                $('#edit-transaction select[name="bank_account"]').val(row.bankaccount_id).trigger(
                'change');
                $('#edit-transaction input[name="amount"]').val(row.amount);
                $('#edit-transaction input[name="transaction_type"]').val([row.transaction_type
                    .toLocaleLowerCase()
                ]);
                $('#edit-transaction textarea[name="note"]').val(row.note);
                $('#edit-transaction').attr("action", href);
                $('#bankAccountEdit').trigger('change');
            })

            $(document).on('submit', '#edit-transaction', function(evt) {
                evt.preventDefault();
                var data = Object.fromEntries(new FormData(evt.target).entries());
                let action = $(this).attr('action');
                $.ajax({
                    url: action,
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#edit-transaction button[type="submit"]').html(
                            LOADING_SPINNER);
                    },
                    success: function(data) {                        
                        if (data.success) {
                            $('#edit-transaction button[type="submit"]').html(
                                "{{ __('Save') }}");
                            Swal.fire({
                                icon: 'success',
                                title: 'Created',
                                text: data.message,
                            });
                            $('#edit-transaction').trigger('reset');
                            $('#bankAccount').val(null).trigger('change');
                            table.ajax.reload(null, false);
                            $('#editTransaction').modal('hide');
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

            @can('bank-transaction-add')
                $('#add-new-transaction').on('submit', function(evt) {
                    evt.preventDefault();
                    let action = $(this).attr('action');
                    let data = Object.fromEntries(new FormData(evt.target).entries())
                    $.ajax({
                        url: action,
                        method: 'post',
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $('#add-new-transaction button[type="submit"]').html(
                                LOADING_SPINNER);
                        },
                        success: function(data) {
                            if (data.success) {
                                $('#add-new-transaction button[type="submit"]').html(
                                    "{{ __('Save') }}");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Created',
                                    text: data.message,
                                });
                                $('#add-new-transaction').trigger('reset');
                                $('#bankAccount').val(null).trigger('change');
                                table.ajax.reload(null, false);
                                $('#addNewTransaction').modal('hide');
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
        });
    </script>
@endpush
