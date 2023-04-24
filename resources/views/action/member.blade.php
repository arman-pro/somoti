@canany(['member-index', 'member-create', 'member-update', 'member-destroy'])
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
        @lang('Action') <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @can('member-index')
                <a class="dropdown-item" href="{{route("member.show", ['member' => $member->id])}}"><i class="fas fa-eye"></i> @lang('View')</a>
            @endif
            @can('member-update')
                <a class="dropdown-item" href="{{route('member.edit', ['member' => $member->id])}}"><i class="fas fa-edit"></i> @lang('Edit')</a>
            @endcan
            @can('member-destroy')
                <button type="button" class="dropdown-item delete_btn" data-href="{{route('member.destroy', ['member' => $member->id])}}"><i class="fas fa-trash"></i> @lang('Delete')</button>
            @endcan
        </div>
    </div>
@endcanany