@extends('layouts.admin')
@section('title', __('Withdraw List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Withdraw List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Withdraw List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a href="{{route('member.index')}}" class="btn btn-sm btn-success">@lang('Member List')</a>
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
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang('Withdraw List')</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang("Saving Withdraw List")</h4>
                </div>
                <div class="card-body">
                    <table id="saving-withdraw-list" class="table table-sm text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Withdraw Type')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Comment')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title">@lang("FDR Withdraw List")</h4>
                </div>
                <div class="card-body">
                    <table id="fdr-withdraw-list" class="table table-sm text-center">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Withdraw Type')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Comment')</th>
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
@endpush

{{-- extra js --}}
@push('js')
 {{-- DataTables  & Plugins --}}
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endpush

@push('js')
    <script>
        $(function () {
            $("#saving-withdraw-list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("withdraw.list", ["member" => $member->id])}}',
                    data: {'type':'saving'},
                    method: 'get',
                },
                columns: [
                    { data: 'id', orderSequence: ["desc"], },
                    { data: 'date' },
                    { data: 'withdraw_type' },
                    { data: 'amount' },
                    { data: 'comment' },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                }
            });

            $("#fdr-withdraw-list").DataTable({
                "columnDefs": [
                    {
                        "targets": -1,
                        "searchable": false,
                        "orderable": false,
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route("withdraw.list", ["member" => $member->id])}}',
                    data: {'type':'fdr'},
                    method: 'get',
                },
                columns: [
                    { data: 'id', orderSequence: ["desc"], },
                    { data: 'date' },
                    { data: 'withdraw_type' },
                    { data: 'amount' },
                    { data: 'comment' },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                }
            });
        });

        $(document).ready(function() {

        });
    </script>
@endpush