@canany(['fdr-index', 'fdr-create', 'fdr-update', 'fdr-destroy'])
{{-- action button group --}}
<div class="btn-group dropleft">
    <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
    @lang('Action') <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">
        @can('fdr-index')
            <a class="dropdown-item" href="{{route("fdr.show", ['fdr' => $fdr->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
        @endif
        @can('fdr-update')
            <a class="dropdown-item" href="{{route('fdr.edit', ['fdr' => $fdr->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
        @endcan
        @can('fdr-destroy')
            <button type="button" class="dropdown-item delete_btn" data-href="{{route('fdr.destroy', ['fdr' => $fdr->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
        @endcan
    </div>
</div>
@endcanany