<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
  <div class="container-fluid">
    <div class="main-header-left ">
      <div class="responsive-logo">
        <a href="{{ route('home') }}">
          <img src="{{ URL::asset('assets/img/brand/logo.png') }}" class="logo-1" alt="logo">
        </a>
        <a href="{{ route('home') }}"><img src="{{ URL::asset('assets/img/brand/logo-white.png') }}"
            class="dark-logo-1" alt="logo"></a>
        <a href="{{ route('home') }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
            class="logo-2" alt="logo"></a>
        <a href="{{ route('home') }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
            class="dark-logo-2" alt="logo"></a>
      </div>
      <div class="app-sidebar__toggle" data-toggle="sidebar">
        <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
        <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
      </div>
    </div>
    <div class="main-header-right">
      <div class="nav">
        <div class=" dropdown nav-itemd-none d-md-flex">
          <a href="#" class="d-flex nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
            <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
              ENG
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
            <a href="#" class="dropdown-item d-flex ">
              <span class="avatar  ml-3 align-self-center bg-transparent">
                AR
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="nav nav-item navbar-nav-right ml-auto">
        <div class="dropdown nav-item main-header-notification">
          <a class="new nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-bell">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            @if (auth()->user()->unreadNotifications->count() > 0)
							<span class="pulse"></span>
						@endif
          </a>
          <div class="dropdown-menu">
            <div class="menu-header-content bg-primary text-left">
              <div class="d-flex">
                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">
                  Notifications
                </h6>
								@if (auth()->user()->unreadNotifications->count() > 0)
							<a class="badge badge-pill badge-warning ml-auto my-auto float-right" href="{{ route('mark-read') }}">Mark All Read</a>
						@endif

              </div>
              <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                You have {{ auth()->user()->unreadNotifications->count() }} unread Notifications
              </p>
            </div>
            <div class="main-notification-list Notification-scroll">
							@foreach (auth()->user()->unreadNotifications()->limit(4)->get() as $notification)
								<a class="d-flex p-3 border-bottom" href="{{ route('invoices.show', $notification->data['invoice_id']) }}">
									<div class="notifyimg bg-pink">
										<i class="la la-file-alt text-white"></i>
									</div>
									<div class="ml-3">
										<h5 class="notification-label mb-1">{{ $notification->data['title'] }}</h5>
										<div class="notification-subtext">Created at {{ $notification->created_at->format('d-M-Y') }}</div>
									</div>
									<div class="ml-auto">
										<i class="las la-angle-right text-right text-muted"></i>
									</div>
								</a>
							@endforeach
            </div>
						@if (auth()->user()->unreadNotifications->count() > 4)
							<div class="dropdown-footer">
              <a href="">VIEW ALL</a>
            </div>
						@endif
          </div>
        </div>
        <div class="nav-item full-screen fullscreen-button">
          <a class="new nav-link full-screen-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-maximize">
              <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
              </path>
            </svg>
          </a>
        </div>
        <div class="dropdown main-profile-menu nav nav-item nav-link">
          <a class="profile-user d-flex" href="">
            <img alt="" src="{{ asset('storage/avatar/default_profile.svg') }}">
          </a>
          <div class="dropdown-menu">
            <div class="main-header-profile bg-primary p-3">
              <div class="d-flex wd-100p">
                <div class="main-img-user">
                  <img alt="" src="{{ asset('storage/avatar/default_profile.svg') }}"
                    class="">
							</div>
							<div class=" ml-3 my-auto">
                  <h6>{{ ucfirst(auth()->user()->name) }}</h6>
                  <span>{{ ucfirst(auth()->user()->roles->first()->name) }}</span>
                </div>
              </div>
            </div>
            <a class="dropdown-item" href="{{ route('users.show', auth()->id()) }}"><i class="bx bx-user-circle"></i>Profile</a>
            <a class="dropdown-item" href="#"
              onclick="event.preventDefault();document.getElementById('logoutform').submit()"><i
                class="bx bx-log-out"></i> Sign Out</a>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /main-header -->
