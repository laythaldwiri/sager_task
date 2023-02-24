<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('super_admin.dashboard') }}" title="Dashboard">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name text-truncate">Sager Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <ul class="nav sidebar-inner" id="sidebar-menu">
                {{-- =================================================== --}}
                {{-- ==================== Dashboard ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.dashboard') }}">
                        <i class="mdi mdi-desktop-mac-dashboard"></i>
                        <span class="nav-text" style="font-size: 10pt;">Dashboard</span>
                    </a>
                </li>

                {{-- =================================================== --}}
                {{-- ====================== Stores ===================== --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#stores"
                        aria-expanded="false" aria-controls="users">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span class="nav-text" style="font-size: 10pt;"> Storehouse </span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="stores" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            
                            {{-- =================================================== --}}
                            {{-- ===================== Categories ================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.categories-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> Categories</span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- ====================== Products =================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.products-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> Products</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- =================================================== --}}
                {{-- ======================= Users ===================== --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#users"
                        aria-expanded="false" aria-controls="users">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span class="nav-text" style="font-size: 10pt;"> Users </span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="users" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            {{-- =================================================== --}}
                            {{-- =================== All Users ===================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.customers-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> All Users</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- =================================================== --}}
                {{-- ================ Website Settings ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#website_setting" aria-expanded="false" aria-controls="website_setting">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span class="nav-text" style="font-size: 10pt;"> Website Settings </span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="website_setting" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- =================================================== --}}
                            {{-- ================= Support Tickets ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.support_tickets-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> Support Tickets</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                {{-- =================================================== --}}
                {{-- ===================== Logout ====================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.support_tickets-index') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                        <span class="nav-text" style="font-size: 10pt;"> Logout</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</aside>
