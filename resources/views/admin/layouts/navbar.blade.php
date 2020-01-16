<header class="main-header" style="background:#26b1b0;" >
    <!-- Logo -->
    <a href="{{route('adminHome')}}" class="logo" style="background:#26b1b0;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini col-xs-12 col-sm-12"><b>G</b>B</span>
        <!-- logo for regular state and mobile devices -->
        <span id="otI" class="logo-lg hidden-xs hidden-sm">Go bus</span>
        <span id="ot" class="hidden-md hidden-lg col-xs-12 col-sm-12"><b>V</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background:#26b1b0;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle once1" data-toggle="push-menu" role="button" >
            <span class="sr-only">Toggle navigation</span>
        </a>

     @include('admin.layouts.menu')
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li  >
                <a class="{{session()->get('menu') == 'home' ? 'activeitem' : ''}}" href="{{route('adminHome')}}">
                    <i class="fa fa-home "></i> <span >Home</span>
                    <span class="pull-right-container "></span>
                </a>
            </li>
            <li>
                <a class="{{session()->get('menu') == 'user' ? 'activeitem' : ''}}" href="{{route('adminUser.index')}}">
                    <i class="fa fa-users"></i> <span>Driver</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a class="{{session()->get('menu') == 'bus' ? 'activeitem' : ''}}" href="{{route('AllBuses')}}">
                    <i class="fa fa-users"></i> <span>Bus</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <li id >
                <a class="{{session()->get('menu') == 'station' ? 'activeitem' : ''}}" href="{{route('AllStation')}}">
                    <i class="fa fa-shopping-cart"></i> <span>Stations</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li id >
                <a class="{{session()->get('menu') == 'trip' ? 'activeitem' : ''}}" href="{{route('AllTrips')}}">
                    <i class="fa fa-shopping-cart"></i> <span>All Trips</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li id >
                <a class="{{session()->get('menu') == 'report' ? 'activeitem' : ''}}" href="{{route('allReports')}}">
                    <i class="fa fa-list-alt"></i> <span>Reports</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
