<div class="app-menu navbar-menu">
  

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('warehouse.dashboard') }}" role="button">
                        <i class="bx bxs-dashboard"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('warehouse.product.index') }}" role="button">
                        <i class="bx bxs-store"></i> <span>All Products</span>
                    </a>
                </li> <!-- end All Products Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('warehouse.pick_up_order') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>Pick up orders</span>
                    </a>
                </li> <!-- end Pick up orders Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('warehouse.return_order') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>Return orders</span>
                    </a>
                </li> <!-- end Return orders Menu -->
                

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>