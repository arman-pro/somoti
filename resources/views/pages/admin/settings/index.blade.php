@extends('layouts.admin')
@section('title', 'General Settings')

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">General Settings</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item ">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">General Settings</li>
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
                    <h4 class="card-title">General Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('settings.general')}}" method="post">
                        @csrf
                        <input type="hidden" name="institution_id" value="{{$setting->institution_id}}"/>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="website_title">Website Title</label>
                                    <input type="text" name="title" value="{{$setting->title}}" id="website_title" class="form-control" placeholder="Website Title"/>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" value="{{$setting->facebook}}" id="facebook" placeholder="Facebook" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" value="{{$setting->phone}}" id="phone" placeholder="Phone Number" class="form-control"/>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="phone">Currency</label><br/>
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
                                    <label for="active_sms">Active SMS</label><br/>
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

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label><br/>
                                    <input type="email" value="{{$setting->email}}" name="email" placeholder="E-mail" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="timezone">TimeZone</label><br/>
                                    <select name="timezone" id="timezone" class="form-control" >
                                        <option value="" hidden>Select TimeZone</option>
                                        @foreach(['Asia/Dhaka', 'Asia/Kolkata'] as $timezone)
                                        <option value="{{$timezone}}" @if($setting->timezone == $timezone) selected @endif >{{$timezone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="address">Address</label><br/>
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{$setting->address}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="is_maitanence_mood">Maintainence Mood</label>
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

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Save Changes</button>
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