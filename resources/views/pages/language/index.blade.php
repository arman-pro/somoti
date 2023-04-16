@extends('layouts.admin')
@section('title', __('All Language'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">@lang('All Language')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item active">@lang('All Language')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <a href="{{route('language.create')}}" class="btn btn-sm btn-success">@lang('Add New Language')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-10 m-auto col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('All Language')</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Title')</th>
                                <th>@lang('Slug')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($languages as $language)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$language->title}}</td>
                                <td>{{$language->slug}}</td>
                                <td>
                                    <a href="{{route('translate', ['language' => $language->id])}}" class="btn btn-sm btn-dark">@lang('Translate')</a>
                                    @can('language-update')
                                    <a href="{{route("language.edit", ['language' => $language->id ])}}" class="btn btn-sm btn-info">@lang('Edit')</a>
                                    @endcan
                                    @can('language-destroy')
                                    <a
                                        href="javascript:void(0)"
                                        class="btn btn-sm btn-danger delete_btn"
                                        data-link="{{route("language.destroy", ["language" => $language->id])}}"
                                    >@lang('Delete')</a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="4">@lang('Data Not Found!')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @can('language-destroy')
    <form action="" method="post" id="delete_form">@csrf @method("DELETE")</form>
    @endcan
@endsection

{{-- extra css --}}
@push('css')
<link rel="stylesheet" href="{{asset("plugins/sweetalert2/sweetalert2.min.css")}}" />
@endpush

{{-- extra js --}}
@push('js')
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".delete_btn", function() {
            let link = $(this).data("link");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('Delete')'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete_form").attr("action", link).submit();
                }
            })
        })
    });
</script>
@endpush