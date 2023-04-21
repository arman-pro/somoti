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
            <form action="{{route('member.store')}}" method="post">
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
                                    <label for="joinDate">@lang('Join Date')</label>
                                    <div class="input-group date" id="joinDatePickerOne" data-target-input="nearest">
                                        <input type="text" name="join_date" placeholder="@lang('Join Date')" data-toggle="joinDatePicker" id="joinDate"  class="form-control form-control-sm @error('join_date') is-invalid @enderror datetimepicker-input" data-target="#joinDatePickerOne" />
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
                                    <label for="acount">@lang('A/C No')</label>
                                    <input type="text" name="acount" placeholder="@lang('A/C No')" value="{{old('acount')}}" id="acount" class="form-control form-control-sm @error('acount') is-invalid @enderror ">
                                    @error('acount')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" placeholder="@lang('Name')" value="{{old('name')}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror ">
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">@lang('Mobile')</label>
                                    <input type="tel" name="mobile" placeholder="@lang('Mobile')" value="{{old('mobile')}}" id="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror "/>
                                    @error('mobile')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="father_name">@lang('Father Name')</label>
                                    <input type="text" name="father_name" placeholder="@lang('Father Name')" value="{{old('father_name')}}" id="father_name" class="form-control form-control-sm @error('father_name') is-invalid @enderror "/>
                                    @error('father_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="mother_name">@lang('Mother Name')</label>
                                    <input type="text" name="mother_name" placeholder="@lang('Mother Name')" value="{{old('mother_name')}}" id="mother_name" class="form-control form-control-sm @error('mother_name') is-invalid @enderror "/>
                                    @error('mother_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dob">@lang('Date Of Birth')</label>
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" name="date_of_birth" placeholder="@lang('Date Of Birth')" data-toggle="datetimepicker" id="date_of_birth"  class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror datetimepicker-input" data-target="#datetimepicker1" required/>
                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('date_of_birth')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="gender">@lang('Gender')</label>
                                    <select name="gender" id="gender" class="form-control form-control-sm @error('gender') is-invalid @enderror">
                                        <option value="" hidden>@lang("Select a Gender")</option>
                                        <option @if(old('gender') == 'male') selected @endif value="male">@lang('Male')</option>
                                        <option @if(old('gender') == 'female') selected @endif value="female">@lang('Female')</option>
                                        <option @if(old('gender') == 'other') selected @endif value="other">@lang('Other')</option>
                                    </select>
                                    @error('gender')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="religion">@lang('Religion')</label>
                                    <select name="religion" id="religion" class="form-control form-control-sm @error('religion') is-invalid @enderror">
                                        <option value="" hidden>@lang('Select a Religion')</option>
                                        <option @if(old('religion') == 'muslim') selected @endif value="muslim">@lang('Muslim')</option>
                                        <option @if(old('religion') == 'hindu') selected @endif value="hindu">@lang('Hindu')</option>
                                        <option @if(old('religion') == 'cristan') selected @endif value="cristan">@lang('Cristan')</option>
                                        <option @if(old('religion') == 'other') selected @endif value="other">@lang("Other")</option>
                                    </select>
                                    @error('religion')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="profession">@lang('Profession')</label>
                                    <input type="text" name="profession" placeholder="@lang('Profession')" value="{{old('profession')}}" id="profession" class="form-control form-control-sm @error('profession') is-invalid @enderror "/>
                                    @error('profession')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="business_name">@lang('Business Name')</label>
                                    <input type="text" name="business_name" placeholder="@lang('Business Name')" value="{{old('business_name')}}" id="business_name" class="form-control form-control-sm @error('business_name') is-invalid @enderror "/>
                                    @error('business_name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
                                    <label for="branch">@lang('Branch')</label>
                                    <select name="branch" id="branch" class="form-control form-control-sm @error('branch') is-invalid @enderror">
                                        <option value="" hidden>@lang('Select a Branch')</option>
                                    </select>
                                    @error('branch')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="area">@lang('Area')</label>
                                    <select name="area" id="area" class="form-control form-control-sm @error('area') is-invalid @enderror">
                                        <option value="" hidden>@lang('Select a Area')</option>
                                    </select>
                                    @error('area')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="group">@lang('Group')</label>
                                    <select name="group" id="group" class="form-control form-control-sm @error('group') is-invalid @enderror">
                                        <option value="" hidden>@lang('Select a Group')</option>
                                    </select>
                                    @error('group')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
                                    <input type="text" name="division" placeholder="@lang('Division')" value="{{old('division')}}" id="division" class="form-control form-control-sm @error('division') is-invalid @enderror "/>
                                    @error('division')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="district">@lang('District')</label>
                                    <input type="text" name="district" placeholder="@lang('District')" value="{{old('district')}}" id="district" class="form-control form-control-sm @error('district') is-invalid @enderror "/>
                                    @error('district')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="upzilla">@lang('Thana/Upzilla')</label>
                                    <input type="text" name="upzilla" placeholder="@lang('Thana/Upzilla')" value="{{old('upzilla')}}" id="upzilla" class="form-control form-control-sm @error('upzilla') is-invalid @enderror "/>
                                    @error('upzilla')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="post_office">@lang('Post Office')</label>
                                    <input type="text" name="post_office" placeholder="@lang('Post Office')" value="{{old('post_office')}}" id="post_office" class="form-control form-control-sm @error('post_office') is-invalid @enderror "/>
                                    @error('post_office')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="village">@lang('Village')</label>
                                    <input type="text" name="village" placeholder="@lang('Village')" value="{{old('village')}}" id="village" class="form-control form-control-sm @error('village') is-invalid @enderror "/>
                                    @error('village')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icheck-primary icheck-inline">
                                <input type="checkbox" id="chb1" />
                                <label for="chb1">Same Permanent Address</label>
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
                                    <label for="division">@lang('Division')</label>
                                    <input type="text" name="division" placeholder="@lang('Division')" value="{{old('division')}}" id="division" class="form-control form-control-sm @error('division') is-invalid @enderror "/>
                                    @error('division')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="district">@lang('District')</label>
                                    <input type="text" name="district" placeholder="@lang('District')" value="{{old('district')}}" id="district" class="form-control form-control-sm @error('district') is-invalid @enderror "/>
                                    @error('district')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="upzilla">@lang('Thana/Upzilla')</label>
                                    <input type="text" name="upzilla" placeholder="@lang('Thana/Upzilla')" value="{{old('upzilla')}}" id="upzilla" class="form-control form-control-sm @error('upzilla') is-invalid @enderror "/>
                                    @error('upzilla')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="post_office">@lang('Post Office')</label>
                                    <input type="text" name="post_office" placeholder="@lang('Post Office')" value="{{old('post_office')}}" id="post_office" class="form-control form-control-sm @error('post_office') is-invalid @enderror "/>
                                    @error('post_office')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="village">@lang('Village')</label>
                                    <input type="text" name="village" placeholder="@lang('Village')" value="{{old('village')}}" id="village" class="form-control form-control-sm @error('village') is-invalid @enderror "/>
                                    @error('village')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
                                    <input type="file" name="nominee[nid]" class="custom-file-input @error('nominee.nid') is-invalid @enderror" id="nominee_nid" />
                                    <label class="custom-file-label" for="nominee_nid">@lang('Nominee NID')...</label>
                                    @error('nominee.nid')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="nominee_other_document">@lang('Other Document')</label>
                                <div class="custom-file">
                                    <input type="file" name="nominee[other_document]" class="custom-file-input @error('nominee.other_document') is-invalid @enderror" id="nominee_other_document" />
                                    <label class="custom-file-label" for="nominee_other_document">@lang('Other Document')...</label>
                                    @error('nominee.other_document')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
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
                                    <input type="file" name="member[nid]" class="custom-file-input @error('member.nid') is-invalid @enderror" id="member_nid" />
                                    <label class="custom-file-label" for="member_nid">@lang('Member NID')...</label>
                                    @error('member.nid')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="member_other_document">@lang('Other Document')</label>
                                <div class="custom-file">
                                    <input type="file" name="member[other_document]" class="custom-file-input @error('member.other_document') is-invalid @enderror" id="member_other_document" />
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
                                <div class="card m-auto" style="max-width: 18rem;">
                                    <div class="card-header">@lang('Member Profile')</div>
                                    <div class="card-body">
                                        <img src="{{asset('avatar.png')}}" alt="member avatar" class="img-thumbnail m-auto">
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-sm btn-secondary">@lang('Upload') <i class="fa fa-upload"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger">@lang('Cancel') <i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card m-auto" style="max-width: 18rem;">
                                    <div class="card-header">@lang('Nominee Profile')</div>
                                    <div class="card-body">
                                        <img src="{{asset('avatar.png')}}" alt="nominee avatar" class="img-thumbnail m-auto">
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-sm btn-secondary">@lang('Upload') <i class="fa fa-upload"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger">@lang('Cancel') <i class="fa fa-trash"></i></button>
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
@endpush

{{-- extra js --}}
@push('js')
{{-- date picker --}}
<script src="{{asset('plugins/moment/moment.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: "DD/MM/YYYY",
                date: moment()
            });

            $('#joinDatePickerOne').datetimepicker({
                format: "DD/MM/YYYY",
                date: moment()
            });
        });
    });
</script>
@endpush