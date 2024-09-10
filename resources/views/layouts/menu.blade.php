<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}" role="button">
                        <i class="bx bxs-dashboard"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->routeIs('marketplace.index')) active @endif" href="{{ route('marketplace.index') }}" role="button">
                        <i class="bx bxs-store"></i> <span>Marketplace</span>
                    </a>
                </li> <!-- end Marketplace Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->routeIs('product.index')) active @endif" href="{{ route('product.index') }}" role="button">
                        <i class="bx bxs-wallet"></i> <span>My Products</span>
                    </a>
                </li> <!-- end My Products Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->routeIs('order.index')) active @endif" href="{{ route('order.index') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>Orders</span>
                    </a>
                </li> <!-- end Orders Menu -->

                <li class="nav-item ">
                    <a class="nav-link menu-link @if(request()->routeIs('setting.wallet')) active @endif" href="{{ route('setting.wallet') }}" role="button">
                        <i class="ri-wallet-3-fill"></i> <span>Wallet</span>
                    </a>
                </li> <!-- end Orders Menu -->


                

                

                

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>