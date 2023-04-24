@extends('layouts.admin')
@section('title', __('Add New Member'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('Add New Member')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Add New Member')</li>
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
            <form action="{{route('member.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Add New Member')</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Member Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="joinDate">@lang('Join Date')*</label>
                                    <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                        <input type="text" name="join_date" placeholder="@lang('Join Date')" data-toggle="joinDatePicker" id="joinDate"  class="form-control form-control-sm @error('join_date') is-invalid @enderror datetimepicker-input" data-target="#joinDatePickerOne" required/>
                                        <div class="input-group-append" data-target="#joinDatePickerOne" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('join_date')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="member_no">@lang('Member No')</label>
                                    <input type="text" name="member_no" placeholder="@lang('Memebr No')" value="{{old('member_no')}}" id="member_no" class="form-control form-control-sm @error('member_no') is-invalid @enderror ">
                                    @error('member_no')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="account">@lang('A/C No')</label>
                                    <input type="text" name="account" placeholder="@lang('A/C No')" value="{{old('account')}}" id="account" class="form-control form-control-sm @error('account') is-invalid @enderror ">
                                    @error('account')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')*</label>
                                    <input type="text" name="name" placeholder="@lang('Name')" value="{{old('name')}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror " required>
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">@lang('Mobile')*</label>
                                    <input type="tel" name="mobile" placeholder="@lang('Mobile')" value="{{old('mobile')}}" id="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror " required/>
                                    @error('mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="father_name">@lang('Father Name')</label>
                                    <input type="text" name="info[father_name]" placeholder="@lang('Father Name')" value="{{old('info.father_name')}}" id="father_name" class="form-control form-control-sm @error('info.father_name') is-invalid @enderror "/>
                                    @error('info.father_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mother_name">@lang('Mother Name')</label>
                                    <input type="text" name="info[mother_name]" placeholder="@lang('Mother Name')" value="{{old('info.mother_name')}}" id="mother_name" class="form-control form-control-sm @error('info.mother_name') is-invalid @enderror "/>
                                    @error('info.mother_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dob">@lang('Date Of Birth')</label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" name="info[date_of_birth]" placeholder="@lang('Date Of Birth')" data-toggle="datetimepicker" id="date_of_birth"  class="form-control form-control-sm @error('info.date_of_birth') is-invalid @enderror datetimepicker-input" data-target="#datetimepicker1"/>
                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('info.date_of_birth')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="gender">@lang('Gender')</label>
                                    <select name="info[gender]" id="gender" class="form-control form-control-sm @error('info.gender') is-invalid @enderror">
                                        <option value="" hidden>@lang("Select a Gender")</option>
                                        <option @if(old('info.gender') == 'male') selected @endif value="male">@lang('Male')</option>
                                        <option @if(old('info.gender') == 'female') selected @endif value="female">@lang('Female')</option>
                                        <option @if(old('info.gender') == 'other') selected @endif value="other">@lang('Other')</option>
                                    </select>
                                    @error('info.gender')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="religion">@lang('Religion')</label>
                                    <select name="info[religion]" id="religion" class="form-control form-control-sm @error('info.religion') is-invalid @enderror">
                                        <option value="" hidden>@lang('Select a Religion')</option>
                                        <option @if(old('info.religion') == 'muslim') selected @endif value="muslim">@lang('Muslim')</option>
                                        <option @if(old('info.religion') == 'hindu') selected @endif value="hindu">@lang('Hindu')</option>
                                        <option @if(old('info.religion') == 'cristan') selected @endif value="cristan">@lang('Cristan')</option>
                                        <option @if(old('info.religion') == 'other') selected @endif value="other">@lang("Other")</option>
                                    </select>
                                    @error('info.religion')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="profession">@lang('Profession')</label>
                                    <input type="text" name="info[profession]" placeholder="@lang('Profession')" value="{{old('info.profession')}}" id="profession" class="form-control form-control-sm @error('info.profession') is-invalid @enderror "/>
                                    @error('info.profession')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="business_name">@lang('Business Name')</label>
                                    <input type="text" name="info[business_name]" placeholder="@lang('Business Name')" value="{{old('info.business_name')}}" id="business_name" class="form-control form-control-sm @error('info.business_name') is-invalid @enderror "/>
                                    @error('info.business_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Branch Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="branch">@lang('Branch')*</label>
                                    <select name="branch_id" id="branch" class="form-control form-control-sm @error('branch_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Branch')</option>
                                    </select>
                                    @error('branch_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="area">@lang('Area')*</label>
                                    <select name="area_id" id="area" class="form-control form-control-sm @error('area_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Area')</option>
                                    </select>
                                    @error('area_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="group">@lang('Group')*</label>
                                    <select name="group_id" id="group" class="form-control form-control-sm @error('group_id') is-invalid @enderror" required/>
                                        <option value="" hidden>@lang('Select a Group')</option>
                                    </select>
                                    @error('group_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Present Address')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="division">@lang('Division')</label>
                                    <input type="text" name="address[division]" placeholder="@lang('Division')" value="{{old('address.division')}}" id="division" class="form-control form-control-sm address @error('address.division') is-invalid @enderror "/>
                                    @error('address.division')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="district">@lang('District')</label>
                                    <input type="text" name="address[district]" placeholder="@lang('District')" value="{{old('address.district')}}" id="district" class="form-control form-control-sm address @error('address.district') is-invalid @enderror "/>
                                    @error('address.district')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="upzilla">@lang('Thana/Upzilla')</label>
                                    <input type="text" name="address[upzilla]" placeholder="@lang('Thana/Upzilla')" value="{{old('address.upzilla')}}" id="upzilla" class="form-control form-control-sm address @error('address.upzilla') is-invalid @enderror "/>
                                    @error('address.upzilla')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="post_office">@lang('Post Office')</label>
                                    <input type="text" name="address[post_office]" placeholder="@lang('Post Office')" value="{{old('address.post_office')}}" id="post_office" class="form-control form-control-sm address @error('address.post_office') is-invalid @enderror "/>
                                    @error('address.post_office')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="village">@lang('Village')</label>
                                    <input type="text" name="address[village]" placeholder="@lang('Village')" value="{{old('address.village')}}" id="village" class="form-control form-control-sm address @error('address.village') is-invalid @enderror "/>
                                    @error('address.village')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icheck-primary icheck-inline">
                                <input type="checkbox" id="same_as_present_address" />
                                <label for="same_as_present_address">@lang('Same Permanent Address')</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Permanent Address')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="per_division">@lang('Division')</label>
                                    <input type="text" name="permanentAddress[division]" placeholder="@lang('Division')" value="{{old('permanentAddress.division')}}" id="per_division" class="form-control form-control-sm @error('permanentAddress.division') is-invalid @enderror "/>
                                    @error('permanentAddress.division')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="per_district">@lang('District')</label>
                                    <input type="text" name="permanentAddress[district]" placeholder="@lang('District')" value="{{old('permanentAddress.district')}}" id="per_district" class="form-control form-control-sm @error('permanentAddress.district') is-invalid @enderror "/>
                                    @error('permanentAddress.district')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="per_upzilla">@lang('Thana/Upzilla')</label>
                                    <input type="text" name="permanentAddress[upzilla]" placeholder="@lang('Thana/Upzilla')" value="{{old('permanentAddress.upzilla')}}" id="per_upzilla" class="form-control form-control-sm @error('permanentAddress.upzilla') is-invalid @enderror "/>
                                    @error('permanentAddress.upzilla')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="per_post_office">@lang('Post Office')</label>
                                    <input type="text" name="permanentAddress[post_office]" placeholder="@lang('Post Office')" value="{{old('permanentAddress.post_office')}}" id="per_post_office" class="form-control form-control-sm @error('permanentAddress.post_office') is-invalid @enderror "/>
                                    @error('permanentAddress.post_office')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="per_village">@lang('Village')</label>
                                    <input type="text" name="permanentAddress[village]" placeholder="@lang('Village')" value="{{old('permanentAddress.village')}}" id="per_village" class="form-control form-control-sm @error('permanentAddress.village') is-invalid @enderror "/>
                                    @error('permanentAddress.village')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Nominee Information')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_name">@lang('Name')</label>
                                    <input type="text" name="nominee[name]" placeholder="@lang('Name')" value="{{old('nominee.name')}}" id="nominee_name" class="form-control form-control-sm @error('nominee.name') is-invalid @enderror "/>
                                    @error('nominee.name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_relation">@lang('Relation With Member')</label>
                                    <input type="text" name="nominee[relation]" placeholder="@lang('Relation With Member')" value="{{old('nominee.relation')}}" id="nominee_relation" class="form-control form-control-sm @error('nominee.relation') is-invalid @enderror "/>
                                    @error('nominee.relation')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_father">@lang('Father Name')</label>
                                    <input type="text" name="nominee[father]" placeholder="@lang('Father Name')" value="{{old('nominee.father')}}" id="nominee_father" class="form-control form-control-sm @error('nominee.father') is-invalid @enderror "/>
                                    @error('nominee.father')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_mobile">@lang('Mobile')</label>
                                    <input type="text" name="nominee[mobile]" placeholder="@lang('Mobile')" value="{{old('nominee.mobile')}}" id="nominee_mobile" class="form-control form-control-sm @error('nominee.mobile') is-invalid @enderror "/>
                                    @error('nominee.mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_division">@lang('Division')</label>
                                    <input type="text" name="nominee[division]" placeholder="@lang('Division')" value="{{old('nominee.division')}}" id="nominee_division" class="form-control form-control-sm @error('nominee.division') is-invalid @enderror "/>
                                    @error('nominee.division')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_district">@lang('District')</label>
                                    <input type="text" name="nominee[district]" placeholder="@lang('District')" value="{{old('nominee.district')}}" id="nominee_district" class="form-control form-control-sm @error('nominee.district') is-invalid @enderror "/>
                                    @error('nominee.district')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_upzilla">@lang('Thana/Upzilla')</label>
                                    <input type="text" name="nominee[upzilla]" placeholder="@lang('Thana/Upzilla')" value="{{old('nominee.upzilla')}}" id="nominee_upzilla" class="form-control form-control-sm @error('nominee.upzilla') is-invalid @enderror "/>
                                    @error('nominee.upzilla')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_post_office">@lang('Post Office')</label>
                                    <input type="text" name="nominee[post_office]" placeholder="@lang('Post Office')" value="{{old('nominee.post_office')}}" id="nominee_post_office" class="form-control form-control-sm @error('nominee.post_office') is-invalid @enderror "/>
                                    @error('nominee.post_office')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nominee_village">@lang('Village')</label>
                                    <input type="text" name="nominee[village]" placeholder="@lang('Village')" value="{{old('nominee.village')}}" id="nominee_village" class="form-control form-control-sm @error('nominee.village') is-invalid @enderror "/>
                                    @error('nominee.village')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
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
                                <label for="nominee_nid">@lang('Nominee NID')</label>
                                <div class="custom-file">
                                    <input type="file" name="nominee_docs[nid]" accept="image/*,.pdf" class="custom-file-input @error('nominee_docs.nid') is-invalid @enderror" id="nominee_nid" />
                                    <label class="custom-file-label" for="nominee_nid">@lang('Nominee NID')...</label>
                                    @error('nominee_docs.nid')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="nominee_other_document">@lang('Other Document')</label>
                                <div class="custom-file">
                                    <input type="file" name="nominee_docs[other_document]" accept="image/*,.pdf" class="custom-file-input @error('nominee_docs.other_document') is-invalid @enderror" id="nominee_other_document" />
                                    <label class="custom-file-label" for="nominee_other_document">@lang('Other Document')...</label>
                                    @error('nominee_docs.other_document')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
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
                                <label for="member_nid">@lang('Member NID')</label>
                                <div class="custom-file">
                                    <input type="file" name="member[nid]" accept="image/*,.pdf" class="custom-file-input @error('member.nid') is-invalid @enderror" id="member_nid" />
                                    <label class="custom-file-label" for="member_nid">@lang('Member NID')...</label>
                                    @error('member.nid')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="member_other_document">@lang('Other Document')</label>
                                <div class="custom-file">
                                    <input type="file" name="member[other_document]" accept="image/*,.pdf" class="custom-file-input @error('member.other_document') is-invalid @enderror" id="member_other_document" />
                                    <label class="custom-file-label" for="member_other_document">@lang('Other Document')...</label>
                                    @error('member.other_document')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Profile')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                {{-- hidden file input --}}
                                <input type="file" accept="image/*" name="memberProfile" id="memberProfile" style="display: none;" />
                                <div class="card m-auto" style="max-width: 18rem;">
                                    <div class="card-header">@lang('Member Profile')</div>
                                    <div class="card-body">
                                        <img id="memberProfilePreview" src="{{asset('avatar.png')}}" alt="member avatar" class="img-thumbnail m-auto">
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" data-target="#memberProfile" class="btn btn-sm btn-secondary uploadBtn">@lang('Upload') <i class="fa fa-upload"></i></button>
                                        <button type="button" data-target="#memberProfile"  class="btn btn-sm btn-danger cancelBtn">@lang('Cancel') <i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                {{-- hidden file input --}}
                                <input type="file" accept="image/*" name="nomineeProfile" id="nomineeProfile" style="display: none;" />
                                <div class="card m-auto" style="max-width: 18rem;">
                                    <div class="card-header">@lang('Nominee Profile')</div>
                                    <div class="card-body">
                                        <img id="nomineeProfilePreview" src="{{asset('avatar.png')}}" alt="nominee avatar" class="img-thumbnail m-auto">
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" data-target="#nomineeProfile" class="btn btn-sm btn-secondary uploadBtn">@lang('Upload') <i class="fa fa-upload"></i></button>
                                        <button type="button" data-target="#nomineeProfile" class="btn btn-sm btn-danger cancelBtn">@lang('Cancel') <i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- extra css --}}
@push('css')
{{-- date picker --}}
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" crossorigin="anonymous" />
{{-- nice selecte --}}
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" crossorigin="anonymous" />
{{-- bootstrap select 2 --}}
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
{{-- bootstrap 4 select 2 theme --}}
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

{{-- extra js --}}
@push('js')
 {{-- bootstrap select 2 --}}
 <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
{{-- date picker --}}
<script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
@endpush

@push('js')
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: "{{dataFormat()}}",
            date: moment()
        });

        $('#joinDatePickerOne').datetimepicker({
            format: "{{dataFormat()}}",
            date: moment()
        });
    });

    $(document).ready(function() {
        var branches = @json($branches);
        $('#branch').select2({
            theme: "bootstrap4",
            allowClear: true,
            placeholder: "@lang('Select a Branch')",
            data: branches,
        });

        $('#branch').on('change', function(){
            var branch_id = $(this).val();
            var branch = branches.find((item) => item.id == branch_id);
            if(branch)
                var areas = branch.areas;
            else
                var areas = [];

            $('#area').html('').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Area')",
                data: areas,
            }).trigger('change');
        });

        $('#area').on('change', function(){
            var branch_id = $("#branch").val();
            var area_id = $(this).val();
            var branch = branches.find((branch) => branch.id == branch_id);
            if(branch)
                var area = branch.areas.find((area) => area.id == area_id);
            else
                var area = null;
            if(area)
                var groups = area.groups;
            else
                var groups = [];
            $('#group').html('').select2({
                theme: "bootstrap4",
                allowClear: true,
                placeholder: "@lang('Select a Group')",
                data: groups,
            });
        });

        /**
         * click same as present address
         * fill permanent address
         */
        $("#same_as_present_address").on('change', function() {
            var address = $('.address');
            if($(this).is(":checked")) {
                for(let elem of address) {
                    var id = $(elem).attr('id');
                    var value = $(elem).val();
                    $('#per_'+id+'').val(value);
                }
            }else {
                for(let elem of address) {
                    var id = $(elem).attr('id');
                    $('#per_'+id+'').val('');
                }
            }
        });

        /**
         * file select and show file name in label text
         */
        $(document).on('change', '.custom-file-input', function(e) {
            var fileName = e.target.files[0].name;
            var parent = $(this).parent();
            parent.find('label').html(fileName);
        });

        /**
         * uploda image and preview
         */
        $(document).on("click", ".uploadBtn", function() {
            var target = $(this).data('target');
            $(target).trigger('click').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    $(target+'Preview').attr('src', reader.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });

        /**
         * click cancel button and remove selected file
         */
        $(document).on("click", ".cancelBtn", function() {
            var target = $(this).data('target');
            $(target).val('');
            $(target+"Preview").attr("src", "{{asset('avatar.png')}}");
        });
    })

</script>
@endpush