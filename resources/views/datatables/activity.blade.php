<ul class="list-group list-group-flush">
    @if($activity->properties != '')
        <li class="list-group-item text-sm">@lang('Changes Description')</li>
        @foreach($activity->properties as $propKey => $property)
            <li class="list-group-item text-center p-1 text-xs"><b>{{ucfirst($propKey)}}<b></li>
            @forelse ($property as $key => $value)
            <li class="list-group-item p-1 text-xs">{{$key}} : {{$value}}</li>
            @empty
            @endforelse
        @endforeach
    @else
        <li class="list-group-item text-center">@lang('Data Not Found!')</li>
    @endif
</ul>