@canany(['loan-index', 'loan-create', 'loan-update', 'loan-destroy'])
    {{-- action button group --}}
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
            @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @can('loan-index')
                <a class="dropdown-item" href="{{ route('loan.show', ['loan' => $loan->id]) }}">
                    <i class="fas fa-eye"></i> @lang('View')
                </a>
                @endif
                @can('loan-update')
                    <a class="dropdown-item" href="{{ route('loan.edit', ['loan' => $loan->id]) }}">
                        <i class="fas fa-edit"></i> @lang('Edit')
                    </a>
                @endcan
                @can('loan-destroy')
                    <button
                        type="button" class="dropdown-item delete_btn"
                        data-href="{{ route('loan.destroy', ['loan' => $loan->id]) }}"
                        data-id="{{$loan->id}}"
                    >
                        <i class="fas fa-trash"></i> @lang('Delete')
                    </button>
            @endcan
        </div>
    </div>
@endcanany
