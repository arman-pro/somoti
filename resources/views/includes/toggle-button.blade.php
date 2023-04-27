<input
    type="checkbox"
    name="{{$name ?? "active_status"}}"
    value="{{$value ?? "1"}}"
    id="{{$id ?? $name}}"
    data-toggle="{{$dataToggle ?? "toggle"}}"
    data-onstyle="{{ $dataOnStyle ?? "success" }}"
    data-offstyle="{{ $dataOffStyle ?? "warning"}}"
    @if($checked)
        checked
    @endif
/>

{{-- extra css --}}
@push('css')
{{-- Bootstrap Switch --}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

{{-- extra js --}}
@push('js')
 <!-- Bootstrap Switch -->
 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush