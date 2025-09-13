<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <h3 class="text-white">{{projectNameShort()}}</h3>
            </span>
            <span class="logo-lg">
                <h3 class="text-white mt-3">{{projectNameHeader()}}</h3>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <h3 class="text-white">{{projectNameShort()}}</h3>
            </span>
            <span class="logo-lg">
                <h3 class="text-white mt-3">{{projectNameHeader()}}</h3>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                    alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">{{ auth()->user()->name }}</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}!</h6>
            <a class="dropdown-item" href="{{ route('profile') }}"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
               
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
              
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#purchase" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-shopping-cart-line"></i><span data-key="t-apps">Purchase</span>
                    </a>
                    <div class="collapse menu-dropdown" id="purchase">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a onclick="newWindow('{{ route('purchase.create') }}')" class="nav-link"
                                    data-key="t-chat">Create Purchase</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purchase.index', ['start' => firstDayOfMonth(), 'end' => now()->toDateString()]) }}" class="nav-link" data-key="t-chat"> Purchase
                                    History </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#export" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-shopping-cart-line"></i><span data-key="t-apps">Export</span>
                    </a>
                    <div class="collapse menu-dropdown" id="export">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a onclick="newWindow('{{ route('export.create') }}')" class="nav-link"
                                    data-key="t-chat">Create Export</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('export.index')}}" class="nav-link" data-key="t-chat"> Export
                                    History </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
               {{--  <li class="nav-item">
                    <a class="nav-link menu-link" href="#finance" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-wallet-2-line"></i><span data-key="t-apps">Finance</span>
                    </a>
                    <div class="collapse menu-dropdown" id="finance">
                        <ul class="nav nav-sm flex-column">
                           
                            <li class="nav-item">
                                <a href="{{ route('receive_payments.index') }}" class="nav-link"
                                    data-key="t-chat">Receive Payment</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('issue_payments.index') }}" class="nav-link"
                                    data-key="t-chat">Issue Payment</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment_categories.index') }}" class="nav-link"
                                    data-key="t-chat">Payment Category</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#reports" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-file-list-line"></i><span data-key="t-apps">Reports</span>
                    </a>
                    <div class="collapse menu-dropdown" id="reports">
                        <ul class="nav nav-sm flex-column">
                           
                            <li class="nav-item">   
                                <a href="{{ route('reportLedger') }}" class="nav-link"
                                    data-key="t-chat">Ledger</a>
                            </li> 
                            <li class="nav-item">   
                                <a href="{{ route('reportPurchase') }}" class="nav-link"
                                    data-key="t-chat">Purchase</a>
                            </li> 
                            
                        </ul>
                    </div>
                </li> --}}
               {{--  <li class="nav-item">
                    <a class="nav-link menu-link" href="#stock" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="stock">
                        <i class="ri-car-line"></i><span data-key="t-apps">Stock</span>
                    </a>
                    <div class="collapse menu-dropdown" id="stock">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('stock.index', 'All') }}" class="nav-link"
                                    data-key="t-chat">All</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.index', 'Available') }}" class="nav-link"
                                    data-key="t-chat">Available</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.index', 'Exported') }}" class="nav-link"
                                    data-key="t-chat">Exported</a>
                            </li>
                            
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                            <a class="nav-link menu-link" href="#settings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                                <i class="ri-settings-2-line"></i> <span data-key="t-multi-level">Settings</span>
                            </a>
                            <div class="collapse menu-dropdown" id="settings">
                                <ul class="nav nav-sm flex-column">
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('yards.index') }}" class="nav-link" data-key="t-level-1.1"> Yards </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ route('auctions.index') }}" class="nav-link" data-key="t-level-1.1"> Auctions </a>
                                    </li>
                                   {{--  <li class="nav-item">
                                        <a href="{{ route('parts.index') }}" class="nav-link" data-key="t-level-1.1"> Parts </a>
                                    </li> --}}
                                   {{--  <li class="nav-item">
                                        <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2"> 
                                            Accounts
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarAccount">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{ route('account.create') }}" class="nav-link" data-key="t-level-2.1"> Create Account </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('accountsList', 'Bank') }}" class="nav-link" data-key="t-level-2.1"> Bank </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('accountsList', 'Consignee') }}" class="nav-link" data-key="t-level-2.1"> Consignee </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('accountsList', 'Transporter') }}" class="nav-link" data-key="t-level-2.1"> Transporter </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
