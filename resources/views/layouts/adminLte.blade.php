<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App Admin</title>
    
    {{-- CSS Styles =========================================== --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- linkar o bootstrap direto pois o app.css está quebrando o layout no admin --}}

    {{-- Font Awesome Icons --}}
    <link href="{{ asset('css/adminLte/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('css/adminLte/plugins/toastr/toastr.min.css') }}">

    {{-- overlayScrollbars --}}
    <link href="{{ asset('css/adminLte/plugins/overlayScrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
    
    {{-- Theme style --}}
    <link href="{{ asset('css/adminLte/adminlte.min.css') }}" rel="stylesheet">
    
    {{-- Google Font: Source Sans Pro --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
        <a href="{{ url('admin') }}" class="brand-link">
                <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ url('my-profile') }}" class="d-block {{ Request::is('admin/my-profile' ) ? 'active': ''}}">
                            {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}<br>
                            <small>{{ Auth::user()->position->name }} / {{ Auth::user()->role->name }}</small>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">ENTERPRISE</li>
                        {{-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Enterprise <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview"> --}}
                                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                                <li class="nav-item">
                                    <a href="{{ url('admin/config') }}" class="nav-link {{ Request::is('admin/config' ) ? 'active': ''}}">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Config</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/clients') }}" class="nav-link {{ Request::is('admin/clients' ) ? 'active': ''}}">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Clients</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/employees') }}" class="nav-link {{ Request::is('admin/employees' ) ? 'active': ''}}">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Employees</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/employee-positions') }}" class="nav-link {{ Request::is('admin/employee-positions' ) ? 'active': ''}}">
                                        <i class="nav-icon fas fa-user-secret"></i>
                                        <p>Employees Positions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/roles') }}" class="nav-link {{ Request::is('admin/roles' ) ? 'active': ''}}">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/stores') }}" class="nav-link {{ Request::is('admin/stores' ) ? 'active': ''}}">
                                        <i class="fas fa-store nav-icon"></i>
                                        <p>Stores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/suppliers') }}" class="nav-link {{ Request::is('admin/suppliers' ) ? 'active': ''}}">
                                        <i class="fas fa-hand-spock nav-icon"></i>
                                        <p>Suppliers</p>
                                    </a>
                                </li>
                            {{-- </ul>
                        </li> --}}
                        <li class="nav-header">E-COMMERCE</li>
                        {{-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>E-commerce <i class="right fas fa-angle-left"></i></p>
                            </a> --}}
                            {{-- <ul class="nav nav-treeview"> --}}
                                <li class="nav-item">
                                    <a href="{{ url('admin/categories') }}" class="nav-link {{ Request::is('admin/categories' ) ? 'active': ''}}">
                                        <i class="fas fa-network-wired nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/coupons') }}" class="nav-link {{ Request::is('admin/coupons' ) ? 'active': ''}}">
                                        <i class="fas fa-percentage nav-icon"></i> 
                                        <p>Discount Coupons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/installment-status') }}" class="nav-link {{ Request::is('admin/installment-status' ) ? 'active': ''}}">
                                        <i class="fas fa-funnel-dollar nav-icon"></i> 
                                        <p>Installment Status</p>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{ url('admin/orders') }}" class="nav-link {{ Request::is('admin/orders' ) ? 'active': ''}}">
                                        <i class="fas fa-shopping-cart nav-icon"></i>
                                        <p>Orders</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/payment-methods') }}" class="nav-link {{ Request::is('admin/payment-methods' ) ? 'active': ''}}">
                                        <i class="far fa-credit-card nav-icon"></i>
                                        <p>Payment Methods</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/payment-status') }}" class="nav-link {{ Request::is('admin/payment-status' ) ? 'active': ''}}">
                                        <i class="fas fa-project-diagram nav-icon"></i>
                                        <p>Payment Status</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/products') }}" class="nav-link {{ Request::is('admin/products' ) ? 'active': ''}}">
                                        <i class="fas fa-box-open nav-icon"></i>
                                        <p>Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/shipping-methods') }}" class="nav-link {{ Request::is('admin/shipping-methods' ) ? 'active': ''}}">
                                        <i class="fas fa-dolly nav-icon"></i>
                                        <p>Shipping Methods</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/wish-list') }}" class="nav-link {{ Request::is('admin/wish-list' ) ? 'active': ''}}">
                                        <i class="fas fa-gifts nav-icon"></i>
                                        <p>Wish List</p>
                                    </a>
                                </li>
                            {{-- </ul> --}}
                        {{-- </li> --}}
                        
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Pages <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/pages/about') }}" class="nav-link {{ Request::is('admin/pages/about' ) ? 'active': ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>About</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/pages/contact') }}" class="nav-link {{ Request::is('admin/pages/contact' ) ? 'active': ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/pages/faq') }}" class="nav-link {{ Request::is('admin/pages/faq' ) ? 'active': ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Faq</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/pages/home') }}" class="nav-link {{ Request::is('admin/pages/home' ) ? 'active': ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">STATISTICS</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Reports<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/charts/flot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Flot</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')            
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- JS Scripts --}}
    {{-- JQuery, Bootstrap, Datatables --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- REQUIRED SCRIPTS -->
    {{-- jQuery -->
    {{-- <script src="plugins/jquery/jquery.min.js"></script> --}}
    {{-- Bootstrap -->}}
    {{-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    
    {{-- overlayScrollbars --}}
    <script src="{{ asset('js/adminLte/plugins/overlayScrollbars/jquery.overlayScrollbars.min.js') }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ asset('js/adminLte/adminlte.min.js') }}"></script>
    {{-- OPTIONAL SCRIPTS --}}
    <script src="{{ asset('js/adminLte/demo.js') }}"></script>
    {{-- PAGE PLUGINS --}}
    {{-- jQuery Mapael --}}
    <script src="{{ asset('js/adminLte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('js/adminLte/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('js/adminLte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('js/adminLte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    {{-- Toastr --}}
    <script src="{{ asset('js/adminLte/plugins/toastr/toastr.min.js') }}"></script>
    {{-- ChartJS --}}
    <script src="{{ asset('js/adminLte/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- PAGE SCRIPTS --}}
    <script src="{{ asset('js/adminLte/pages/dashboard2.js') }}"></script>

    @yield('js_scripts')  
</body>
</html>