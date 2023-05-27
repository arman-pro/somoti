@canany(['bank-transaction-edit', 'bank-transaction-delete'])
<div class="btn-group dropleft">
    <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
    @lang('Action') <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">        
        @can('bank-transaction-edit')
            <a class="dropdown-item" href="{{route('bank-account.transaction.edit', ['transaction' => $bankTransaction->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
        @endcan
        @can('bank-transaction-delete')
            <button type="button" class="dropdown-item delete_btn" data-href="#"><i class="fas fa-trash"></i> @lang('Delete')</button>
        @endcan
    </div>
</div>
@endcanany