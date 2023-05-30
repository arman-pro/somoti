@extends('layouts.admin')
@section('title', __('Expense List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Expense List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Expense List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('expense-create')
                        <a href="{{route('expense.create')}}" class="btn btn-sm btn-success">@lang('Add New Expense')</a>
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Expense List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="expense_list" class="table table-sm table-striped table-bordered">
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
    {{-- delete form --}}
    <form action="" id="delete_form" method="post">@csrf @method("DELETE")</form>
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
        $(function () {
            $("#expense_list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ]
            })
        });

        $(document).ready(function(){
            // delete user
            $(document).on('click', '.delete_btn', function(){
                let href = $(this).data('href');
                Swal.fire({
                    title: 'Are you sure to Delete?',
                    text: "You won't be able to undo this.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '@lang('Delete')'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete_form').attr('action', href).submit();
                    }
                })
            });

        });

    </script>
@endpush