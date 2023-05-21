@canany(['sharePurchase-index', 'sharePurchase-create', 'sharePurchase-update', 'sharePurchase-destroy'])                               
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
        @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @can('sharePurchase-update')
                <a class="dropdown-item edit-btn" href="javascript:void(0)" data-href="{{route('share-purchase.edit', ['share_purchase' => $share->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
            @endcan
            @can('sharePurchase-destroy')
                <button type="button" class="dropdown-item delete_btn" data-href="{{route('share-purchase.destroy', ['share_purchase' => $share->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
            @endcan
        </div>
    </div>
@endcanany