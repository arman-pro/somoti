@canany(['savings-index', 'savings-create', 'savings-update', 'savings-destroy'])
<div class="btn-group dropleft">
    <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
    @lang('Action') <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">
        @can('savings-index')
            <a class="dropdown-item savings_view" href="javascript:void(0)" data-href="{{route("savings.show", ['saving' => $saving->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
        @endif
        @can('savings-update')
            <a class="dropdown-item" href="{{route('savings.edit', ['saving' => $saving->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
        @endcan
        @can('savings-destroy')
            <button type="button" class="dropdown-item delete_btn" data-href="{{route('savings.destroy', ['saving' => $saving->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
        @endcan
    </div>
</div>
@endcanany