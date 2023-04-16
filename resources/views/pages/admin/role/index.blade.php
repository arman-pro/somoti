@extends('layouts.admin')
{{-- page title --}}
@section('title', 'User Role')

{{-- page header --}}
@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">Roles</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Role
                </li>
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
                    <h4 class="card-title">User Role</h4>
                </div>
                <div class="card-body">

                    @if(!$edit)
                    {{-- role created form --}}
                    <form action="{{route('roles.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-10 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control @error('name') invalid @enderror " placeholder="Role"/>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-dark" value="Create"/>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- end role create --}}
                    @endif

                    @if($edit && !is_null($role_))
                    {{-- role update form --}}
                    <form action="{{route('roles.update', ['role' => $role_->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-10 col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name" value="{{$role_->name}}" class="form-control" placeholder="Role"/>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-success" value="Update"/>&nbsp;
                                    <a href="{{route('roles.index')}}" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- end role update --}}
                    @endif

                    {{-- role table  --}}
                    <table class="table table-sm table-striped w-80 m-auto">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @empty($roles)
                                <tr>
                                    <td colspan="2" class="text-muted">No Data Found!</td>
                                </tr>
                            @endempty

                            @foreach ($roles as $role)    
                                                     
                            <tr class="text-center">
                                {{-- hidden delete form --}}
                                <form action="{{route('roles.destroy', ['role' => $role->id])}}" id="destroy-{{$role->id}}" method="post">
                                    @csrf @method('DELETE')
                                </form>
                                {{-- end delete form --}}

                                <td>{{$role->name}}</td>
                                <td>
                                    {{-- action button group --}}
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{route('roles.show', ['role' => $role->id])}}"><i class="fas fa-eye"></i> View</a>
                                        <a class="dropdown-item" href="{{route('roles.edit', ['role' => $role->id])}}"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="dropdown-item" href="{{route('permission', ['role' => $role->id])}}"><i class="fas fa-lock"></i> Change Permission</a>
                                        <button class="dropdown-item delete" data-id="{{$role->id}}" type="button"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- extra js for this page --}}
@push('js')
    <script>
        $(document).ready(function(){
            // delete role
            $('.delete').on('click', function(e){
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure to Delete?',
                    text: "You won't be able to undo this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#destroy-'+id).submit();
                    }
                })
            });
        });
    </script>
@endpush