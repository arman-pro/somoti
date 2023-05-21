@canany(['shareSale-index', 'shareSale-create', 'shareSale-update', 'shareSale-destroy'])                               
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
        @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @can('shareSale-update')
                <a class="dropdown-item edit-btn" href="javascript:void(0)" data-href="{{route('share-sale.edit', ['share_sale' => $share->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
            @endcan
            @can('shareSale-destroy')
                <button type="button" class="dropdown-item delete_btn" data-href="{{route('share-sale.destroy', ['share_sale' => $share->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
            @endcan
        </div>
    </div>
@endcanany