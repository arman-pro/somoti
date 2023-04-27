@extends('layouts.admin')
@section('title', __('Area List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Area List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Area List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('area-create')
                        <a href="{{route('area.create')}}" class="btn btn-sm btn-success">@lang('Add New Area')</a>
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
                    <h4 class="card-title">@lang('Area List')</h4>
                </div>
                <div class="card-body">
                    <table id="area_list" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Branch')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($areas as $area)
                            <tr class="text-center">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$area->name}}</td>
                                <td>{{$area->code}}</td>
                                <td>{{$area->branch->name}}</td>
                                <td>
                                    @if($area->is_active)
                                        <span class="badge badge-success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge-danger">@lang('Deactive')</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @canany(['area-index', 'area-create', 'area-update', 'area-destroy'])
                                    {{-- action button group --}}
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        @lang('Action') <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            {{-- @can('area-index')
                                                <a class="dropdown-item" href="{{route("area.show", ['area' => $area->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
                                            @endif --}}
                                            @can('area-update')
                                                <a class="dropdown-item" href="{{route('area.edit', ['area' => $area->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
                                            @endcan
                                            @can('area-destroy')
                                                <button type="button" class="dropdown-item delete_btn" data-href="{{route('area.destroy', ['area' => $area->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
                                            @endcan
                                        </div>
                                    </div>
                                    @endcanany
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">@lang('No Data Found!')</td>
                            </tr>
                            @endforelse
                        </tbody>
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
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush
{{-- extra js --}}
@push('js')
    {{-- DataTables  & Plugins --}}
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush
{{-- extra js for this page --}}
@push('js')
    <script>
        $(function () {
            $("#area_list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                }
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