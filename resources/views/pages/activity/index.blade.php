@extends('layouts.admin')
@section('title', __('Activity List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Activity List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Activity List')</li>
            </ol>
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
                    <h4 class="card-title">@lang('Activity List')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped" id="activity">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Log At')</th>
                                <th>@lang('Log Name')</th>
                                <th>@lang("Description")</th>
                                <th>@lang('Subject')</th>
                                <th>@lang('Log By')</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
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

        $(document).ready(function(){
            $("#activity").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: '{{route("activity.index")}}',
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'created_at' },
                    { data: 'log_name' },
                    { data: 'description' },
                    { data: 'subject_type' },
                    { data: 'causer.name', },
                    { data: 'action' },
                ],
            });

        });

    </script>
@endpush