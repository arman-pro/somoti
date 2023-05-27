@extends('layouts.admin')
@section('title', __('Edit Bank Account'))

@section('page-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">@lang('Edit Bank Account')</h4>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">@lang("Dashboard")</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('bank-account.index')}}">@lang("Bank List")</a>
                </li>
                <li class="breadcrumb-item active">@lang('Edit Bank Account')</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @can('bank-index')
                        <a href="{{route('bank-account.index')}}" class="btn btn-sm btn-success">@lang('Add New Bank')</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{route('bank-account.update', ['bank_account' => $bankAccount->id])}}" method="post">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Edit Bank Account')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="branch">@lang('Branch')*</label>
                                    <select
                                        name="branch_id"
                                        id="branch" class="form-control @error('branch_id') is-invalid @enderror"
                                        data-placeholder="Select a Branch"
                                        data-allowClear="true"
                                        required
                                    >
                                        <option value="" hidden>@lang('Select a Branch')</option>
                                        @forelse ($branches as $branch)
                                            <option value="{{$branch->id}}" @if($branch->id == $bankAccount->id) selected @endif>{{$branch->name}}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                    @error('branch_id')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">@lang('Name')*</label>
                                    <input type="text" name="name" placeholder="@lang('Name')" value="{{$bankAccount->name}}" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror " required>
                                    @error('name')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="ac_number">@lang('A/C No')*</label>
                                    <input type="text" name="ac_number" placeholder="@lang('A/C No')" value="{{$bankAccount->ac_number}}" id="ac_number" class="form-control form-control-sm @error('ac_number') is-invalid @enderror " required>
                                    @error('ac_number')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="balance">@lang('Balance')*</label>
                                    <input type="number" min="0" step="any" name="balance" placeholder="@lang("Balance")" value="{{$bankAccount->balance}}" id="balance" class="form-control form-control-sm @error('balance') is-invalid @enderror " required/>
                                    @error('balance')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="comment">@lang('Note')</label>
                                    <textarea name="note" id="comment" class="form-control form-control-sm @error('note') is-invalid @enderror " cols="30" rows="2" placeholder="@lang('Note')">{{$bankAccount->note}}</textarea>
                                    @error('note')<p class="m-0 text-danger"><small>{{$message}}</small></p>@enderror
                                </div>
                            </div>                                                       
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-success" type="submit">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- extra css --}}
@push('css')
{{-- bootstrap select 2 --}}
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
{{-- bootstrap 4 select 2 theme --}}
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

{{-- extra js --}}
@push('js')
 {{-- bootstrap select 2 --}}
 <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
@endpush

{{-- extra js for this page --}}
@push('js')
<script>
    $(function() {
        $("#branch").select2({
            "theme": "bootstrap4",
            "placeholder": "Select a Branch",
            allowClear: true
        });
    });
</script>
@endpush