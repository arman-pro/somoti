@canany(['dps-index', 'dps-create', 'dps-update', 'dps-destroy'])
{{-- action button group --}}
<div class="btn-group dropleft">
    <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
    @lang('Action') <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">
        @can('dps-index')
            <a class="dropdown-item" href="{{route("dps.show", ['dp' => $dps->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
        @endif
        @can('dps-update')
            <a class="dropdown-item" href="{{route('dps.edit', ['dp' => $dps->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
        @endcan
        @can('dps-destroy')
            <button type="button" class="dropdown-item delete_btn" data-href="{{route('dps.destroy', ['dp' => $dps->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
        @endcan
    </div>
</div>
@endcanany