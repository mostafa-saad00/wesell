<div class="app-menu navbar-menu">
  

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.order_management.dashboard') }}" role="button">
                        <i class="bx bxs-dashboard"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.order_management.index') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>All orders</span>
                    </a>
                </li> <!-- end All Products Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.order_management.search') }}" role="button">
                        <i class="bx bxs-search-alt-2"></i> <span>Search order</span>
                    </a>
                </li> <!-- end Pick up orders Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.order_management.onebyone') }}" role="button">
                        <i class="bx bxs-right-arrow"></i> <span>Order by Order</span>
                    </a>
                </li> <!-- end Return orders Menu -->
                

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>