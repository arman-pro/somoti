@extends('layouts.admin')
@section('title', __('FDR Type List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('FDR Type List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('FDR Type List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('fdrType-create')
                        <a href="{{route('fdrtype.create')}}" class="btn btn-sm btn-success">@lang('Add New FDR Type')</a>
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
                    <h4 class="card-title">@lang('FDR Type List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="fdrtype_list" class="table table-sm table-striped table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Duration Day')</th>
                                <th>@lang('Interest Rate')</th>
                                <th>@lang('Active Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fdrTypes as $fdrType)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$fdrType->name}}</td>
                                <td>{{$fdrType->code}}</td>
                                <td>{{$fdrType->duration}}</td>
                                <td>{{$fdrType->interest_rate}}</td>
                                <td>
                                    <x-active-status active-status="{{$fdrType->is_active}}" />
                                </td>
                                <td class="text-center">
                                    @canany(['fdrType-index', 'fdrType-create', 'fdrType-update', 'fdrType-destroy'])
                                    {{-- action button group --}}
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        @lang('Action') <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            {{-- @can('fdrType-index')
                                                <a class="dropdown-item" href="{{route("fdrtype.show", ['fdrtype' => $fdrType->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
                                            @endif --}}
                                            @can('fdrType-update')
                                                <a class="dropdown-item" href="{{route('fdrtype.edit', ['fdrtype' => $fdrType->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
                                            @endcan
                                            @can('fdrType-destroy')
                                                <button type="button" class="dropdown-item delete_btn" data-href="{{route('fdrtype.destroy', ['fdrtype' => $fdrType->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
                                            @endcan
                                        </div>
                                    </div>
                                    @endcanany
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">@lang('No Data Found!')</td>
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
            $("#fdrtype_list").DataTable({
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