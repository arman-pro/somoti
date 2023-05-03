@if ($isActive)
    <span class="badge badge-{{$onType}}">{{$onMessage}}</span>
@else
    <span class="badge badge-{{$offType}}">{{$offMessage}}</span>
@endif