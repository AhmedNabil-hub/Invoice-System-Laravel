<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
  <div class="main-sidebar-header active">
    <a class="desktop-logo logo-light active" href="{{ route('home') }}"><img
        src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
    <a class="desktop-logo logo-dark active" href="{{ route('home') }}">
			<img src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme" alt="logo">
		</a>
    <a class="logo-icon mobile-logo icon-light active" href="{{ route('home') }}"><img
        src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
    <a class="logo-icon mobile-logo icon-dark active" href="{{ route('home') }}"><img
        src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme" alt="logo"></a>
  </div>
  <div class="main-sidemenu">
    <div class="app-sidebar__user clearfix">
      <div class="dropdown user-pro-body">
        <div class="">
					<img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('storage/avatar/default_profile.svg') }}">
					<span class="avatar-status profile-status bg-green"></span>
        </div>
        <div class="user-info">
          <h4 class="font-weight-semibold mt-3 mb-0">{{ ucfirst(auth()->user()->name) }}</h4>
          <span class="mb-0 text-muted">{{ ucfirst(auth()->user()->roles->first()->name) }}</span>
        </div>
      </div>
    </div>
    <ul class="side-menu">
      <li class="side-item side-item-category">{{ strtoupper(__('mainSidebar.main')) }}</li>
      <li class="slide">
        <a class="side-menu__item" href="{{ route('home') }}">
					<i class="fas fa-home fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.home')) }}</span>
					{{-- <span class="badge badge-success side-badge">1</span> --}}
				</a>
      </li>
      <li class="side-item side-item-category">{{ strtoupper(__('mainSidebar.admin')) }}</li>
      <li class="slide">
        <a class="side-menu__item" href="{{ route('users.index') }}">
					<i class="fas fa-users fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.users')) }}</span>
				</a>
      </li>
      <li class="slide">
        <a class="side-menu__item" href="{{ route('roles.index') }}">
					<i class="fas fa-user-tag fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.roles')) }}</span>
				</a>
      </li>

      <li class="side-item side-item-category">{{ strtoupper(__('mainSidebar.manager')) }}</li>
      <li class="slide">
        <a class="side-menu__item" href="{{ route('sections.index') }}">
					<i class="fas fa-layer-group fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.sections')) }}</span>
				</a>
      </li><li class="slide">
        <a class="side-menu__item" href="{{ route('products.index') }}">
					<i class="fas fa-shopping-bag fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.products')) }}</span>
				</a>
      </li>

      <li class="side-item side-item-category">{{ strtoupper(__('mainSidebar.employee')) }}</li>
      </li><li class="slide">
        <a class="side-menu__item" href="{{ route('invoices.index') }}">
					<i class="fas fa-file-alt fa-fw mr-3"></i>
					<span class="side-menu__label">{{ ucfirst(__('mainSidebar.invoices')) }}</span>
				</a>
      </li>


    </ul>
  </div>
</aside>
<!-- main-sidebar -->
