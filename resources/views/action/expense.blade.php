@canany(['expense-index', 'expense-create', 'expense-update', 'expense-destroy'])
    {{-- action button group --}}
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
            @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @can('expense-index')
                <a class="dropdown-item" href="{{ route('expense.show', ['expense' => $expense->id]) }}"><i class="fas fa-eye"></i>
                    @lang('View')</a>
                @endif
                @can('expense-update')
                    <a class="dropdown-item" href="{{ route('expense.edit', ['expense' => $expense->id]) }}"><i
                            class="fas fa-edit"></i> @lang('Edit')</a>
                @endcan
                @can('expense-destroy')
                    <button type="button" class="dropdown-item delete_btn"
                        data-href="{{ route('expense.destroy', ['expense' => $expense->id]) }}"><i class="fas fa-trash"></i>
                        @lang('Delete')</button>
                @endcan
            </div>
        </div>
    @endcanany
