<table class="table table-striped">
    <thead>
        <tbody>
            <tr>
                <td>Name: {{$user->name}}</td>
                <td>Phone: {{$user->phone}}</td>
                <td>E-mail: {{$user->email}}</td>
            </tr>
            <tr>
                <td>Status: {{$user->active_status ? "Active" : "Deactive"}}</td>
                <td>Level: {{$user->level ?? "N/A"}}</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </thead>
</table>
<h4 class="text-center">Permission List</h4>
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
        @if($user->canany([$item.'-index', $item.'-create', $item.'-update', $item.'-destroy']))
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
                @if($user->can($item.'-index'))
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
                @endif                                      
            </td>
            <td>
                @if($user->can($item.'-create'))
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
                @endif
            </td>
            <td>
                @if($user->can($item.'-update'))
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
                @endif
            </td>
            <td>
                @if($user->can($item.'-destroy'))
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
                @endif
            </td>
        </tr>
        @endif
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
            @if($user->canany($per_items))
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
                        @if($user->can($key.'-'.$sub_sub_permission))
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
                        @endif
                    @else 
                        <td>&nbsp;</td>
                    @endif
                @endforeach
            </tr>
            @endif
            @endforeach                                    
        @endforeach
       
    </tbody>
</table>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
