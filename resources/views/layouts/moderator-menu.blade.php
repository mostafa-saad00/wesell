<div class="app-menu navbar-menu">
  

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.dashboard') }}" role="button">
                        <i class="bx bxs-dashboard"></i> <span>Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('moderator.order.index') }}" role="button">
                        <i class="bx bxs-layer"></i> <span>All orders</span>
                    </a>
                </li> <!-- end All orders -->

                @if (App\Models\ConfirmationModerator::where('admin_id', Auth::guard('admin')->user()->id)->first())

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('moderator.confirm_orders.index') }}" role="button">
                            <i class="bx bxs-user-voice"></i> <span>Start Orders Confirmations</span>
                        </a>
                    </li> <!-- end start orders confirmation -->
                    
                @endif

                @if (App\Models\ShippingModerator::where('admin_id', Auth::guard('admin')->user()->id)->first())

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('moderator.shipping_upload_orders.index') }}" role="button">
                            <i class="bx bxs-rocket"></i> <span>Upload Orders to Shipping</span>
                        </a>
                    </li> <!-- end upload orders to shipping -->
                    
                @endif

                

                
                

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>