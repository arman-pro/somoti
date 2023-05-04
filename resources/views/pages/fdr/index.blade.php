@extends('layouts.admin')
@section('title', __('FDR List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('FDR List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('FDR List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('fdr-create')
                        <a href="{{route('fdr.create')}}" class="btn btn-sm btn-success">@lang('Add New FDR')</a>
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
                    <h4 class="card-title">@lang('FDR List')</h4>
                </div>
                <div class="card-body">
                    <table id="fdr_list" class="table table-sm table-striped table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Member Name')</th>
                                <th>@lang('Member ID')</th>
                                <th>@lang('FDR Type')</th>
                                <th>@lang('Start Date')</th>
                                <th>@lang('Expire Date')</th>
                                <th>@lang('Interest Amount')</th>
                                <th>@lang('Matured') @lang('status')</th>
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
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush
{{-- extra js --}}
@push('js')
    {{-- DataTables  & Plugins --}}
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush
{{-- extra js for this page --}}
@push('js')
    <script>
        $(function () {
            $("#fdr_list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{route("fdr.index")}}',
                columns: [
                    { data: 'id', orderSequence: ["desc"], },
                    { data: 'date' },
                    { data: 'member.name', className:'text-left' },
                    { data: 'member.member_no', className:'text-left' },
                    { data: 'fdr_type.name' },
                    { data: 'start_date' },
                    { data: 'expire_date' },
                    { data: 'return_interest' },
                    { data: 'status', orderable:true,searchable:false,name: 'is_matured' },
                    { data: 'action', orderable:false,searchable:false },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                },
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