@extends('layouts.admin')
@section('title', __('Savings List'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Savings List')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Savings List')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('savings-create')
                        <a href="{{route('savings.create')}}" class="btn btn-sm btn-success">@lang('Add New Saving')</a>
                    @endcan
                    <button class="btn btn-sm btn-danger" id="search_button" type="button">Filter</button>
                    @if(request()->filter && auth()->user()->can('savings-index'))
                        <a href="{{route('savings.index')}}" class="btn btn-sm btn-primary">@lang('Clear Filter')</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="content-header" id="search_form">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route("savings.index")}}" method="get">
                                <input type="hidden" name="filter" value="1">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="joinDate">@lang('Date')</label>
                                            <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                                <input type="text" name="date" placeholder="@lang('Date')" data-toggle="joinDatePicker" id="joinDate"  class="form-control form-control-sm datetimepicker-input" data-target="#joinDatePickerOne"/>
                                                <div class="input-group-append" data-target="#joinDatePickerOne" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="branch">@lang('Branch')</label>
                                            <select name="branch" id="branch" class="form-control form-control-sm"/>
                                                <option value="" hidden>@lang('Select a Branch')</option>
                                                @forelse ($branches as $branch)
                                                    <option
                                                        value="{{$branch->id}}"
                                                    >{{$branch->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="area">@lang('Area')</label>
                                            <select name="area" id="area" class="form-control form-control-sm"/>
                                                <option value="" hidden>@lang('Select a Area')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="group">@lang('Group')</label>
                                            <select name="group" id="group" class="form-control form-control-sm"/>
                                                <option value="" hidden>@lang('Select a Group')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="member">@lang('Member')</label>
                                            <select name="member" id="member" class="form-control form-control-sm"/>
                                                <option value="" hidden>@lang('Select a Member')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group" style="margin-top:30px;">
                                            <button type="submit" class="btn btn-sm btn-success">Search <i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    <h4 class="card-title">@lang('Savings List')</h4>
                </div>
                <div class="card-body overflow-auto">
                    <table id="saving_list" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>@lang('SL')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Voucher No')</th>
                                <th>@lang('Member Name')</th>
                                <th>@lang('Branch')</th>
                                <th>@lang('Area')</th>
                                <th>@lang('Group')</th>
                                <th>@lang('Previous Balance')</th>
                                <th>@lang('Saving Amount')</th>
                                <th>@lang('Total')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tfoot>
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
        $(function () {
            $('#search_form').hide();
            $('#search_button').click(function() {
                $('#search_form').toggle();
            })

            var table = $("#saving_list").DataTable({
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
                    'url' : '{{route('savings.index')}}',
                    'data' : @json(request()->all()),
                },
                columns: [
                    { data: 'id', orderSequence: ["desc"], },
                    { data: 'date' },
                    { data: 'voucher_no' },
                    { data: 'member.name', className:'text-left' },
                    { data: 'member.group.area.branch.name' },
                    { data: 'member.group.area.name' },
                    { data: 'member.group.name' },
                    { data: 'pre_balance', orderable:false,searchable:false, className:'text-center' },
                    { data: 'amount', className:'text-center' },
                    { data: 'total_balance', orderable:false,searchable:false, className:'text-center' },
                    { data: 'action', orderable:false,searchable:false },
                ],
                "language": {
                    "searchPlaceholder" : "Search here...",
                    "paginate": {
                        "previous": '<i class="fa fa-angle-double-left"></i>',
                        "next": '<i class="fa fa-angle-double-right"></i>'
                    }
                },
                "drawCallback" : function() {
                    var api = this.api();
                    let total = api.columns(9).data()[0];
                    let amount = api.columns(8).data()[0];
                    if(total.length > 0) {
                        $(api.table('#saving_list').column(9).footer()).html(total.reduce((a,b) => a + b));
                        $(api.table('#saving_list').column(8).footer()).html(amount.reduce((a,b) => a + b));
                    }
                }
            })
        });

        $(document).ready(function(){

            var branches = @json($branches);

            $('#joinDatePickerOne').datetimepicker({
                format: "{{dataFormat()}}",
                date: null,
            });

            $('#member').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Member')",
            });

            $('#branch').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Branch')",
            });

            $('#area').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Area')",
            });

            $('#group').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Group')",
            });

            $("#branch").on('change', function() {
                let branch_id = $(this).val();
                let branch = branches.find(branch => branch.id == branch_id);
                if(branch) {
                    $('#area')
                    .html('<option value="" hidden>@lang("Select a Area")</option>')
                    .select2({
                        theme: "bootstrap4",
                        allowClear: true,
                        placeholder: "@lang('Select a Area')",
                        data: branch.areas.length > 0 ? branch.areas : null ,
                    });
                }
            });

            $('#area').on("change", function () {
                let branch_id = $('#branch').val();
                let area_id = $(this).val();
                let area = branches.find(branch => branch.id == branch_id).areas.find(area => area.id == area_id);
                if(area) {
                    $('#group')
                    .html('<option value="" hidden>@lang("Select a Group")</option>')
                    .select2({
                        theme: "bootstrap4",
                        allowClear: true,
                        placeholder: "@lang('Select a Group')",
                        data: area.groups.length > 0 ? area.groups : null,
                    });
                }
            });

            $('#group').on('change', function () {
                let branch_id = $('#branch').val();
                let area_id = $("#area").val();
                let group_id = $(this).val();
                let group = branches.find(branch => branch.id == branch_id)
                            .areas.find(area => area.id == area_id)
                            .groups.find(group => group.id == group_id);
                if(group) {
                    $('#member')
                    .html('<option value="" hidden>@lang("Select a Member")</option>')
                    .select2({
                        theme: "bootstrap4",
                        allowClear: true,
                        placeholder: "@lang('Select a Member')",
                        data: group.members.length > 0 ? group.members : null,
                    });
                }
            });

            $(document).on('click', '.savings_view', function() {
                let href = $(this).data("href");
                $("#view_modal").modal('show');
                $.ajax({
                    url: href,
                    method: "GET",
                    dataType: "text",
                    beforeSend: function()  {
                        $('#view_title').text('@lang("Savings Details")');
                        $('#view_body').html(LOADING_SPINNER);
                    },
                    success: function(data) {
                        $("#view_body").html(data);
                    },
                    error: function(data) {
                        $("#view_modal").modal('hide');
                        Swal.fire({
                            title: "OOps!",
                            text: "Something went worng!",
                            icon: "error",
                        });
                    }
                })

            })

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