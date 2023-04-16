@extends('layouts.admin')
@section('title', 'Institution Settings')

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">Institution Settings</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item ">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Institution Settings</li>
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
                    <h4 class="card-title">Institution Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{route("settings.institution_update", ['institution' => $institution->id])}}" method="post">
                        @csrf
                        @method('PUT')
                  
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Institution Name*</label>
                                        <input type="text" name="institution_name" id="name" class="form-control @error('institution_name') is-invalid @enderror" placeholder="Institution Name" value="{{$institution->name}}" required />
                                        @error('institution_name') <p class="m-0 text-danger"><small>{{$message}}</small></p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="head_of_institution">Institution Head*</label>
                                        <input type="text"  name="head_of_institution" id="head_of_institution" class="form-control @error('head_of_institution') is-invalid @enderror" value="{{$institution->head_of_institution}}" placeholder="Institution Head"  required>
                                        @error('head_of_institution') <p class="m-0 text-danger"><small>{{$message}}</small></p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="phone">Phone*</label>
                                        <input type="tel" value="{{$institution->phone}}" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number"  required>
                                        @error('phone') <p class="m-0 text-danger"><small>{{$message}}</small></p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" value="{{$institution->email}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" />
                                        @error('email') <p class="m-0 text-danger"><small>{{$message}}</small></p> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="address">Address*</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="20" rows="3" required placeholder="Address">{{$institution->address}}</textarea>
                                        @error('address') <p class="m-0 text-danger"><small>{{$message}}</small></p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Active Status</label> <br/>
                                        <input 
                                            type="checkbox" 
                                            name="is_active" 
                                            value="true" 
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"   
                                            data-offstyle="warning" 
                                            @if($institution->is_active) checked @endif  
                                        />
                                    </div>
                                    <p class="text-danger"><u>N:T: Your institution will deactivated and you won'\t be able to access your information.</u></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{route('dashboard')}}" class="btn btn-outline-danger">Back</a>
                                <button type="submit" class="btn btn-dark float-right">Save Changes</button>
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