@extends('layouts.admin')
@section('title', __('Loan List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">@lang('Loan List')</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Loan List')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('loan-create')
                        <a href="{{ route('loan.create') }}" class="btn btn-sm btn-success">@lang('Add New Loan')</a>
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
                    <h4 class="card-title">@lang('Loan List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="loan_list" class="table table-sm table-striped table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Member') (@lang('Member No.'))</th>
                                <th>@lang('Loan Type')</th>
                                <th>@lang('Loan Amount')</th>
                                <th>@lang('Interest')</th>
                                <th>@lang('Total Amount Payable')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- delete form --}}
    <form action="" id="delete_form" method="post">@csrf @method('DELETE')</form>
@endsection

{{-- extra css --}}
@push('css')
    {{-- data tables style --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" />
@endpush
{{-- extra js --}}
@push('js')
    {{-- DataTables  & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
{{-- extra js for this page --}}
@push('js')
    <script>
        var table = null;
        $(function() {

            table = $("#loan_list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{route("loan.index")}}',
                columns: [
                    { data: 'id', orderSequence: ["desc"], className: 'text-center' },
                    { data: 'date' },
                    { data: 'member.name', className:'text-left' },
                    { data: 'loan_type.name', className:'text-left' },
                    { data: 'amount' },
                    { data: 'interest' },
                    { data: 'total_amount_payable' },
                    { data: 'status', orderable:true,searchable:false,name: 'is_paid' },
                    { data: 'action', orderable:false,searchable:false },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                },
                "createdRow": function( row, data, dataIndex ) {
                    $(row).attr('id', 'row'+data.id);
                }
            });
        });

        // delete user
        $(document).on('click', '.delete_btn', function(){
            let href = $(this).data('href');
            let id = $(this).data('id');
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
                                    table.row($('#row'+id)).remove().draw(false);
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

    </script>
@endpush
