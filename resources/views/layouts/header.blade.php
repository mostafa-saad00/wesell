<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="@admin {{ route('admin.dashboard') }} @else {{ route('dashboard') }}  @endadmin" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="@admin {{ route('admin.dashboard') }} @else {{ route('dashboard') }}  @endadmin" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
                        </span>
                    </a>
                </div>

            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    @admin
                                        {{ Auth::guard('admin')->user()->name }}
                                    @else 
                                        {{ Auth::user()->name }}
                                    @endadmin
                                    
                                </span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Mo5talef</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">
                            Welcome
                            @admin
                                {{ Auth::guard('admin')->user()->name }}!
                            @else 
                                {{ Auth::user()->name }}!
                            @endadmin
                        </h6>
                        <a class="dropdown-item" href="{{ route('setting.profile') }}"><i class="ri-user-fill text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="{{ route('setting.wallet') }}"><i class="ri-wallet-3-fill text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Wallet</span></a>
                        <a class="dropdown-item" href="https://www.youtube.com/playlist?list=PL04pSKi4_Q4uOqmv29PnzlMhCdO0JW1A3" target="_blank"><i class="bx bxs-videos text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Academy</span></a>
                        <div class="dropdown-divider"></div>
                        
                        @admin


                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <a class="dropdown-item" href="auth-logout-basic.html" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">
                                        Logout
                                    </span>
                                </a>

                            </form>  
                            
                        @else 

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="auth-logout-basic.html" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">
                                        Logout
                                    </span>
                                </a>

                            </form>  

                        @endadmin
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>