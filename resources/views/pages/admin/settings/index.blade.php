@extends('layouts.admin')
@section('title', __('General Settings'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('General Settings')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item ">
                    <a href="{{route('dashboard')}}">@lang('Dashboard')</a>
                </li>
                <li class="breadcrumb-item active">@lang('General Settings')</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('General Settings')</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('settings.general')}}" method="post">
                        @csrf
                        <input type="hidden" name="institution_id" value="{{$setting->institution_id}}"/>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="website_title">@lang('Website Title')</label>
                                    <input type="text" name="title" value="{{$setting->title}}" id="website_title" class="form-control" placeholder="@lang('Website Title')"/>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="facebook">@lang('Facebook')</label>
                                    <input type="text" name="facebook" value="{{$setting->facebook}}" id="facebook" placeholder="@lang('Facebook')" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">@lang('Phone Number')</label>
                                    <input type="tel" name="phone" value="{{$setting->phone}}" id="phone" placeholder="@lang('Phone Number')" class="form-control"/>
                                </div>
                            </div>



                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">@lang('E-mail')</label><br/>
                                    <input type="email" value="{{$setting->email}}" name="email" placeholder="@lang('E-mail')" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="timezone">@lang('TimeZone')</label><br/>
                                    <select name="timezone" id="timezone" class="form-control" >
                                        <option value="" hidden>@lang('Select TimeZone')</option>
                                        @foreach(['Asia/Dhaka', 'Asia/Kolkata'] as $timezone)
                                        <option value="{{$timezone}}" @if($setting->timezone == $timezone) selected @endif >{{$timezone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="dateFormate">@lang('Date Format')</label><br/>
                                    <select name="dateFormat" id="dateFormate" class="form-control" >
                                        <option value="" hidden>@lang('Select Date Format')</option>
                                        <?php
                                            $dateFormats = [
                                                'DD/MM/YYYY', 'MM/DD/YYYY', 'YYYY/DD/MM','YYYY/MM/DD',
                                                'DD-MM-YYYY', 'MM-DD-YYYY', 'YYYY-DD-MM', 'YYYY-MM-DD'
                                            ];
                                        ?>
                                        @foreach($dateFormats as $dateFormat)
                                        <option value="{{$dateFormat}}" @if($setting->dateFormat == $dateFormat) selected @endif >{{$dateFormat}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="address">@lang('Address')</label><br/>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{$setting->address}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="is_maitanence_mood">@lang('Maintainence Mood')</label> <br/>
                                    <input
                                        type="checkbox"
                                        name="is_maitanence_mood"
                                        value="1"
                                        id="is_maitanence_mood"
                                        data-toggle="toggle"
                                        data-onstyle="success"
                                        data-offstyle="warning"
                                        data-on="Active"
                                        data-off="Deactive"
                                        @if($setting->is_maitanence_mood) checked @endif
                                    />
                                    <p class="text-danger"><u>N:T: User can't access the site when it's turn active.</u></p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">@lang('Currency')</label><br/>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="bdt" value="BDT" name="currency" @if($setting->currency =='BDT') checked @endif>
                                        <label for="bdt">
                                            BDT
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="usd" value="USD" name="currency" @if($setting->currency=='USD') checked @endif>
                                        <label for="usd">
                                            USD
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="active_sms">@lang('Active SMS')</label><br/>
                                    <input
                                        type="checkbox"
                                        name="active_sms"
                                        value="1"
                                        data-toggle="toggle"
                                        data-onstyle="success"
                                        data-offstyle="warning"
                                        @if($setting->active_sms) checked @endif
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">@lang('Save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- extra css --}}
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

{{-- page extra js cdn --}}
@push('js')
    <!-- Bootstrap Switch -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush

{{-- extra js --}}
@push('js')

@endpush