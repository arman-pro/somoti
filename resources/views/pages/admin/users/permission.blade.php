@extends('layouts.admin')
{{-- page title --}}
@section('title', 'User Assign Permission')

{{-- page header --}}
@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">User Permission</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('users')}}">Users</a>
                </li>
                <li class="breadcrumb-item active">
                    User Permission
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
            {{-- permission form --}}
            <form action="{{route('users.permission', ['user' => $user->id])}}" method="post">
                @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Permission - (<b><u>{{$user->name}}</u></b>)</h4>
                </div>
                <div class="card-body overflow-auto">
                   
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Module</th>
                                    <th>All</th>
                                    <th>Read</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permission_list as $item)
                                @canany([$item.'-index', $item.'-create', $item.'-update', $item.'-destroy'])
                                <tr class="text-center">
                                    <td>
                                        {{ucfirst($item)}}
                                    </td>
                                    <td>
                                        <input 
                                            type="checkbox" 
                                            id="{{$item . '-checked'}}"
                                            data-item="{{$item}}"
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"                                               
                                            data-offstyle="warning"   
                                            @if(in_array(
                                                $item.'-index', $permissions) && 
                                                in_array($item.'-create', $permissions) && 
                                                in_array($item.'-update', $permissions) && 
                                                in_array($item.'-destroy', $permissions)
                                            ) 
                                                checked 
                                            @endif
                                        />
                                    </td>
                                    <td>
                                        @can($item.'-index')
                                        <input 
                                            type="checkbox" 
                                            name="{{'permission['.$item.'][]'}}" 
                                            value="{{$item.'-index'}}" 
                                            id="{{$item.'-index'}}" 
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"                                               
                                            data-offstyle="warning"   
                                            @if(in_array($item.'-index', $permissions)) checked @endif
                                        />
                                        @else
                                            N/A 
                                        @endcan                                      
                                    </td>
                                    <td>
                                        @can($item.'-create')
                                        <input 
                                            type="checkbox" 
                                            name="{{'permission['.$item.'][]'}}" 
                                            value="{{$item.'-create'}}" 
                                            id="{{$item.'-create'}}" 
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"   
                                            data-offstyle="warning"   
                                            @if(in_array($item.'-create', $permissions)) checked @endif
                                        />
                                        @else 
                                            N/A 
                                        @endcan
                                    </td>
                                    <td>
                                        @can($item.'-update')
                                        <input 
                                            type="checkbox" 
                                            name="{{'permission['.$item.'][]'}}" 
                                            value="{{$item.'-update'}}" 
                                            id="{{$item.'-update'}}" 
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"   
                                            data-offstyle="warning"   
                                            @if(in_array($item.'-update', $permissions)) checked @endif
                                        />
                                        @else 
                                            N/A 
                                        @endcan
                                    </td>
                                    <td>
                                        @can($item.'-destroy')
                                        <input 
                                            type="checkbox" 
                                            name="{{'permission['.$item.'][]'}}" 
                                            value="{{$item.'-destroy'}}" 
                                            id="{{$item.'-destroy'}}" 
                                            data-toggle="toggle" data-size="small"
                                            data-onstyle="success"   
                                            data-offstyle="warning" 
                                            @if(in_array($item.'-destroy', $permissions)) checked @endif  
                                        />
                                        @else 
                                            N/A 
                                        @endcan
                                    </td>
                                </tr>
                                @endcanany
                                @endforeach
                            </tbody>
                        </table>
                       <hr/>
                        <table class="table table-striped">
                            <tbody class="text-center">
                                @foreach ($other_permissions as $key => $sub_permissions)
                                    @foreach ($sub_permissions as $sub_sub_permissions)
                                    <?php
                                        $per_items = [];
                                        foreach($sub_sub_permissions as $sub_key => $sub_sub_permission){
                                            if(!empty($sub_sub_permission))
                                                array_push($per_items, $key.'-'.$sub_sub_permission);

                                        }
                                    ?>
                                    @canany($per_items)
                                    <tr>
                                        <td>{{ucfirst($key)}}</td>
                                        @foreach ($sub_sub_permissions as $sub_key => $sub_sub_permission)
                                            @if(!empty($sub_sub_permission))
                                                <td>
                                                    @if(is_string($sub_key))
                                                        {{$sub_key}}
                                                    @else
                                                        {{ucfirst(str_replace("_", " ", $sub_sub_permission))}} {{ucfirst($key)}}
                                                    @endif
                                                </td>
                                            @else
                                                <td>&nbsp;</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        @foreach ($sub_sub_permissions as $sub_key => $sub_sub_permission)
                                            @if(!empty($sub_sub_permission))
                                                @can($key.'-'.$sub_sub_permission)
                                                <td>
                                                    <input 
                                                        type="checkbox" 
                                                        name="{{'permission['.$key.'][]'}}" 
                                                        value="{{$key.'-'.$sub_sub_permission}}"
                                                        data-toggle="toggle" data-size="small"
                                                        data-onstyle="success"                                               
                                                        data-offstyle="warning"   
                                                        @if(in_array($key.'-'.$sub_sub_permission, $permissions)) checked @endif  
                                                    />
                                                </td> 
                                                @endcan
                                            @else 
                                                <td>&nbsp;</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    @endcan
                                    @endforeach                                    
                                @endforeach
                               
                            </tbody>
                        </table>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">Save Permission</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

{{-- page extra css cdn --}}
@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
@endpush

{{-- page extra js cdn --}}
@push('js')
    <!-- Bootstrap Switch -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush

{{-- extra js for this page --}}
@push('js')
<script>
    $(document).ready(function(){
        var roles = <?php echo json_encode($permission_list); ?>;
        roles.forEach(function(role){
            $('#'+role+'-checked').on('change', function(){
                var list = ['index', 'create', 'update', 'destroy'];
                if($(this).is(':checked')) {
                    list.forEach(function(item) {
                        if(!$('#'+role+'-'+item).is(':checked')) {
                            $('#'+role+'-'+item).bootstrapToggle('on');
                        }
                    });
                }else {
                    list.forEach(function(item) {
                        if($('#'+role+'-'+item).is(':checked')) {
                            $('#'+role+'-'+item).bootstrapToggle('off');
                        }
                    });
                }
            })
        });
        
    });
</script>
@endpush
