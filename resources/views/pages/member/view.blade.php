@extends('layouts.admin')
@section('title', __('Member Details'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Member Details')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('member.index')}}">@lang("Member List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Member Details')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('member-index')
                        <a href="{{route('member.index')}}" class="btn btn-sm btn-success">@lang('Member List')</a>
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
                    <h4 class="card-title">@lang('Member Details')</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Member Information')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td><b>@lang('Join Date')</b>: {{printDateFormat($member->join_date)}}</td>
                                <td><b>@lang('Name')</b>: {{$member->name}}</td>
                                <td><b>@lang('Member No')</b>: {{$member->member_no}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('A/C No')</b>: {{$member->account}}</td>
                                <td><b>@lang('Mobile')</b>: {{$member->mobile ?? "N/A"}}</td>
                                <td>
                                    <b>@lang('Active Status')</b>:
                                    @if($member->is_active)
                                        <span class="badge badge-success">@lang('Active')</span>
                                    @else
                                        <span class="badge badge-danger">@lang('Deactive')</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>@lang('Date Of Birth')</b>: {{printDateFormat(optional($extra_info->member_info)->date_of_birth)}}</td>
                                <td><b>@lang('Gender')</b>: {{optional($extra_info->member_info)->gender ?? "N/A"}}</td>
                                <td><b>@lang('Father Name')</b>: {{optional($extra_info->member_info)->father_name ?? "N/A"}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('Mother Name')</b>: {{optional($extra_info->member_info)->mother_name ?? "N/A"}}</td>
                                <td><b>@lang('Religion')</b>: {{optional($extra_info->member_info)->religion ?? "N/A"}}</td>
                                <td><b>@lang('Business Name')</b>: {{optional($extra_info->member_info)->business_name ?? "N/A"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Branch Information')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td><b>@lang('Branch')</b>: {{$member->group->area->branch->name}}</td>
                                <td><b>@lang('Area')</b>: {{$member->group->area->name}}</td>
                                <td><b>@lang('Group')</b>: {{$member->group->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Present Address')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td><b>@lang('Division')</b>: {{optional($extra_info->member_address->present)->division ?? "N/A"}}</td>
                                <td><b>@lang('District')</b>: {{optional($extra_info->member_address->present)->district ?? "N/A"}}</td>
                                <td><b>@lang('Thana/Upzilla')</b>: {{optional($extra_info->member_address->present)->upzilla ?? "N/A"}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('Post Office')</b>: {{optional($extra_info->member_address->present)->post_office ?? "N/A"}}</td>
                                <td><b>@lang('Village')</b>: {{optional($extra_info->member_address->present)->village ?? "N/A"}}</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Permanent Address')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td><b>@lang('Division')</b>: {{optional($extra_info->member_address->permanent)->division ?? "N/A"}}</td>
                                <td><b>@lang('District')</b>: {{optional($extra_info->member_address->permanent)->district ?? "N/A"}}</td>
                                <td><b>@lang('Thana/Upzilla')</b>: {{optional($extra_info->member_address->permanent)->upzilla ?? "N/A"}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('Post Office')</b>: {{optional($extra_info->member_address->permanent)->post_office ?? "N/A"}}</td>
                                <td><b>@lang('Village')</b>: {{optional($extra_info->member_address->permanent)->village ?? "N/A"}}</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Nominee Information')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td><b>@lang('Name')</b>: {{optional($extra_info->nominee)->name ?? "N/A"}}</td>
                                <td><b>@lang('Relation With Member')</b>: {{optional($extra_info->nominee)->relation ?? "N/A"}}</td>
                                <td><b>@lang('Father Name')</b>: {{optional($extra_info->nominee)->father ?? "N/A"}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('Mobile')</b>: {{optional($extra_info->nominee)->mobile ?? "N/A"}}</td>
                                <td><b>@lang('Division')</b>: {{optional($extra_info->nominee)->division ?? "N/A"}}</td>
                                <td><b>@lang('District')</b>: {{optional($extra_info->nominee)->district ?? "N/A"}}</td>
                            </tr>
                            <tr>
                                <td><b>@lang('Thana/Upzilla')</b>: {{optional($extra_info->nominee)->upzilla ?? "N/A"}}</td>
                                <td><b>@lang('Post Office')</b>: {{optional($extra_info->nominee)->post_office ?? "N/A"}}</td>
                                <td><b>@lang('Village')</b>: {{optional($extra_info->nominee)->village ?? "N/A"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Profile')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->profile)->member)
                            <div class="card m-auto" style="max-width: 18rem;">
                                <div class="card-header">@lang('Member Profile')</div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->profile->member)}}" alt="Member Profile" class="img-thumbnail m-auto"/>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->profile)->nominee)
                            <div class="card m-auto" style="max-width: 18rem;">
                                <div class="card-header">@lang('Nominee Profile')</div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->profile->nominee)}}" alt="Nominee Profile" class="img-thumbnail m-auto"/>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Member Documents')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->member_docs)->nid)
                            <div class="card" style="width:500px;">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('Member NID')</h4>
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->member_docs->nid)}}" class="img-fluid" alt="Member Nid">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->member_docs)->other_document)
                            <div class="card" style="width:500px;">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('Other Document')</h4>
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->member_docs->other_document)}}" class="img-fluid" alt="Other Document">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('Nominee Documents')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->nominee_docs)->nid)
                            <div class="card" style="width:500px;">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('Nominee NID')</h4>
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->nominee_docs->nid)}}" class="img-fluid" alt="Nominee Nid">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if(optional(optional($extra_info->file)->nominee_docs)->other_document)
                            <div class="card" style="width:500px;">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('Other Document')</h4>
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('storage/member/'.$extra_info->file->nominee_docs->other_document)}}" class="img-fluid" alt="Other Document">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- extra css --}}
@push('css')

@endpush

{{-- extra js for this page --}}
@push('js')
    <script>

    </script>
@endpush