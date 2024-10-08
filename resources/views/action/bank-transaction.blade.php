@canany(['bank-transaction-edit', 'bank-transaction-delete'])
<div class="btn-group dropleft">
    <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
    @lang('Action') <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">        
        @can('bank-transaction-edit')
            <a class="dropdown-item edit_btn" href="javascript:void(0)" data-href="{{route('bank-account.transaction.update', ['transaction' => $bankTransaction->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
        @endcan
        @can('bank-transaction-delete')
            <button type="button" data-href="{{route('bank-account.transaction.delete', ['transaction' => $bankTransaction->id])}}" class="dropdown-item delete_btn" ><i class="fas fa-trash"></i> @lang('Delete')</button>
        @endcan
    </div>
</div>
@endcanany