<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <span class="brand-text font-weight-light">Apps</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          {{-- <img src="{{Avatar::create(auth()->user()->name)->toBase64();}}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{route('dashboard')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  @lang('Dashboard')
              </a>
            </li>

          @canany(['member-index', 'member-create'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                @lang('Member')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('member-index')
              <li class="nav-item">
                <a href="{{route('member.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Member List')
                </a>
              </li>
              @endcan

              @can('member-create')
              <li class="nav-item">
                <a href="{{route("member.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Member')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          @canany(['savings-create', 'savings-update'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                @lang('Savings')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('savings-create')
              <li class="nav-item">
                <a href="{{route('savings.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Savings List')
                </a>
              </li>
              @endcan

              @can('savings-update')
              <li class="nav-item">
                <a href="{{route('savings.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Saving')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          @canany(['dpsType-index', 'dpsType-create', 'dps-index', 'dps-create'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                @lang('DPS')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('dpsType-index')
              <li class="nav-item">
                <a href="{{route("dpsType.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('DPS Type List')
                </a>
              </li>
              @endcan

              @can('dpsType-create')
              <li class="nav-item">
                <a href="{{route("dpsType.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New DPS Type')
                </a>
              </li>
              @endcan

              @can('dps-index')
              <li class="nav-item">
                <a href="{{route("dps.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('DPS List')
                </a>
              </li>
              @endcan

              @can('dps-create')
              <li class="nav-item">
                <a href="{{route("dps.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New DPS')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan

          @canany(['fdrType-index', 'fdrType-create', 'fdr-index', 'fdr-create'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                @lang('FDR')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('fdrType-index')
              <li class="nav-item">
                <a href="{{route('fdrtype.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('FDR Type List')
                </a>
              </li>
              @endcan

              @can('fdrType-create')
              <li class="nav-item">
                <a href="{{route("fdrtype.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New FDR Type')
                </a>
              </li>
              @endcan

              @can('fdr-index')
              <li class="nav-item">
                <a href="{{route("fdr.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('FDR List')
                </a>
              </li>
              @endcan

              @can('fdr-create')
              <li class="nav-item">
                <a href="{{route("fdr.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New FDR')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          @canany(['loanType-index', 'loanType-create', 'loan-index', 'loan-create'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-donate"></i>
              <p>
                @lang('Loan')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("loanType.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Loan Type List')
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route("loanType.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Loan Type')
                </a>
              </li>

              @can('loan-index')
              <li class="nav-item">
                <a href="{{route('loan.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Loan List')
                </a>
              </li>
              @endcan

              @can('loan-create')
              <li class="nav-item">
                <a href="{{route("loan.create")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Loan')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                @lang('Collection')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Loan Collection')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Group Wise Collection')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Savings Collection')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('DPS Collection')
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('FDR Collection')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                @lang('Share')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Share Purchase List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add Purchase Share')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Share Sales List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Sale Share')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                @lang('Insurance')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Insurance List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Insurance')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-stamp"></i>
              <p>
                @lang('Withdraw')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Saving Withdraw')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('DPS Withdraw')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('FDR Profit Withdraw')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('FDR Withdraw')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                @lang('Bank')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Bank List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Bank')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Bank Transaction')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                @lang('HR Department')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Employee List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Employee Add')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Salary List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Salary')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                @lang('Fund')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Fund List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Fund')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Fund Withdraw')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-gem"></i>
              <p>
                @lang('Product')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Product List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Product')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Unit')
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Category')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                @lang('Sale')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Sale List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Sale')
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                @lang('Asset')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Asset List')
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Asset')
                </a>
              </li>
            </ul>
          </li>

          {{-- users module --}}
          @canany([
            'user-index', 'user-create',
            'user-update', 'user-destroy'
          ])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                @lang('Users')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('user-index')
              <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('User List')
                </a>
              </li>
              @endcan

              @can('user-create')
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('User Create')
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

        @canany(['language-index', 'language-create', 'language-update', 'language-destroy'])
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                @lang('Language')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @can('language-index')
              <li class="nav-item">
                <a href="{{route("language.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('All Language')
                </a>
              </li>
            @endcan

            @can('language-create')
              <li class="nav-item">
                <a href="{{route('language.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  @lang('Add New Language')
                </a>
              </li>
            @endcan
            </ul>
          </li>
        @endcanany

        {{-- Report Module --}}
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <i class="nav-icon far fa-file-alt"></i>
            <p>
              @lang('Reports')
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                @lang('Loan')
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                @lang('Group Wise Loan')
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                @lang('Cash Book')
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                @lang('Daily Book')
              </a>
            </li>
          </ul>
        </li>

          {{-- settings module --}}
          @canany([
            'role-index', 'role-create', 'role-update',
            'miscellaneous-general_setting', 'branch-index', 'group-index', 'area-index',
          ])
          <li class="nav-item">
            <a href="javascript:void()" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                @lang('Settings')
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('miscellaneous-general_setting')
              <li class="nav-item">
                <a href="{{route('settings.general')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('General Settings')</p>
                </a>
              </li>
              @endcan

              @canany(['role-index', 'role-create', 'role-update', 'role-destroy'])
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Role')</p>
                </a>
              </li>
              @endcanany

              @can('branch-index')
              <li class="nav-item">
                <a href="{{route("branch.index")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Branch')</p>
                </a>
              </li>
              @endcan

              @can('area-index')
              <li class="nav-item">
                <a href="{{route('area.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Area')</p>
                </a>
              </li>
              @endcan

              @can('group-index')
              <li class="nav-item">
                <a href="{{route('group.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Group')</p>
                </a>
              </li>
              @endcan

              @can("miscellaneous-activity_log")
              <li class="nav-item">
                <a href="{{route('activity.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Activity Log')</p>
                </a>
              </li>
              @endcan

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Unit')</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Category')</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('SMS Setting')</p>
                </a>
              </li>

              @can('miscellaneous-database_backup')
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Database Backup')</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany
        </ul>
      </nav>
    </div>
  </aside>