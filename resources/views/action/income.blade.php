@canany(['income-index', 'income-create', 'income-update', 'income-destroy'])
    {{-- action button group --}}
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
            @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            {{-- @can('income-index')
                <a class="dropdown-item" href="{{ route('income.show', ['income' => $income->id]) }}"><i class="fas fa-eye"></i>
                @lang('View')</a>
            @endif --}}
            @can('income-update')
                <a class="dropdown-item edit_btn" href="javascript:void(0)" data-href="{{ route('income.update', ['income' => $income->id]) }}"><i
                            class="fas fa-edit"></i> @lang('Edit')</a>
            @endcan
            @can('income-destroy')
                <button type="button" class="dropdown-item delete_btn"
                    data-href="{{ route('income.destroy', ['income' => $income->id]) }}"><i class="fas fa-trash"></i>
                    @lang('Delete')</button>
            @endcan
        </div>
    </div>
@endcanany
