<div class="app-menu navbar-menu">
  

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.teamleader.dashboard') }}" role="button">
                        <i class="bx bxs-dashboard"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.confirmation_team_orders.index') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>Confirmation Team orders</span>
                    </a>
                </li> <!-- end Confirmation Team orders -->

   
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.shipping_team_orders.index') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>Shipping Team orders</span>
                    </a>
                </li> <!-- end Shipping Team orders -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>