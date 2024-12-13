<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('storage/' . $settings->logo_dark) }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('storage/' . $settings->logo_dark) }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('home') }}">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="menu-title"><span>Modules</span></li>
                @canany(['manage users', 'manage roles'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="user">
                            <i class="ri-account-circle-line"></i> <span>User</span>
                        </a>
                        <div class="collapse menu-dropdown" id="user">
                            <ul class="nav nav-sm flex-column">
                                @can('manage users')
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                                    </li>
                                @endcan
                                @can('manage roles')
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link">Roles</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['manage customers'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#people" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="people">
                            <i class="ri-user-3-line"></i> <span>People</span>
                        </a>
                        <div class="collapse menu-dropdown" id="people">
                            <ul class="nav nav-sm flex-column">
                                @can('manage customers')
                                    <li class="nav-item">
                                        <a href="{{ route('customers.index') }}" class="nav-link">Customers</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany

                @canany(['manage events'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#calender" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="calender">
                            <i class="ri-user-3-line"></i> <span>Events</span>
                        </a>
                        <div class="collapse menu-dropdown" id="calender">
                            <ul class="nav nav-sm flex-column">
                                @can('manage customers')
                                    <li class="nav-item">
                                        <a href="{{ route('cal') }}" class="nav-link">Event Calender</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany


                @canany(['manage invoice'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#inv" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="inv">
                            <i class="mdi mdi-file-document-outline "></i> <span>Invoice</span>
                        </a>
                        <div class="collapse menu-dropdown" id="inv">
                            <ul class="nav nav-sm flex-column">
                                @can('manage orders')
                                    <li class="nav-item">
                                        <a href="{{ route('orders.index') }}" class="nav-link">Invoice</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany



                @canany(['manage expenses'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#roomFacilities" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="roomFacilities">
                            <i class="mdi mdi-office-building"></i> <span>Expenses</span>
                        </a>
                        <div class="collapse menu-dropdown" id="roomFacilities">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">

                                    <a href="{{ route('expense.index') }}" class="nav-link">Expenses</a>
                                    {{-- <a href="{{ route('room-facility.index') }}" class="nav-link">Facility List</a> --}}
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcanany




                @canany(['manage report'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#report" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="purchase">
                            <i class="ri-book-3-line"></i> <span>Reports</span>
                        </a>
                        <div class="collapse menu-dropdown" id="report">
                            <ul class="nav nav-sm flex-column">
                                @can('manage report')
                                    <li class="nav-item">
                                        <a href="{{ route('users.ReportsIndex') }}" class="nav-link">User Report</a>
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        <a href="{{ route('customers.ReportsIndex') }}" class="nav-link">Customer Reports</a>
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('employees.ReportsIndex') }}" class="nav-link">Employees
                                            Reports</a> --}}
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('supplier.ReportsIndex') }}" class="nav-link">Supplier Reports</a> --}}
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('purchase.ReportsIndex') }}" class="nav-link">Purchase Reports</a> --}}
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        <a href="{{ route('product.ReportsIndex') }}" class="nav-link">Expenses Reports</a>
                                    </li>
                                @endcan
                                @can('manage report')
                                    <li class="nav-item">
                                        {{-- <a href="{{ route('booking.ReportsIndex') }}" class="nav-link">Booking Reports</a> --}}
                                    </li>
                                @endcan

                                @can('manage report')
                                    <li class="nav-item">
                                        <a href="{{ route('order.ReportsIndex') }}" class="nav-link">Invoice Reports</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcanany

                @can('manage settings')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('settings.index') }}">
                            <i class="ri-settings-2-line"></i> <span>Settings</span>
                        </a>
                    </li>
                @endcan


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
