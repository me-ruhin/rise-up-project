<div class="sidemenu-area">
            <div class="sidemenu-header">
                <a href="dashboard-ecommerce.html" class="navbar-brand d-flex align-items-center">

                    <span title="Attandence Management System">AMS</span>
                </a>

                <div class="burger-menu d-none d-lg-block">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </div>

                <div class="responsive-burger-menu d-block d-lg-none">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </div>
            </div>

            <div class="sidemenu-body">
                <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>

                @if(Auth::user()->is_admin == 1)
                    <li class="nav-item mm-active">
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                            <span class="icon"><i class='bx bx-user'></i></span>
                            <span class="menu-title">User Management</span>
                        </a>

                        <ul class="sidemenu-nav-second-level">
                            <li class="nav-item">
                                <a href="{{route('admin.users.list')}}" class="nav-link">
                                    <span class="icon"><i data-feather="align-justify"></i></span>
                                    <span class="menu-title">User List</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    @else



                    <li class="nav-item">
                        <a href="{{route('member.reports')}}" class="nav-link">
                            <span class="icon"><i class='bx bx-calendar'></i></span>
                            <span class="menu-title">Attendance</span>
                        </a>
                    </li>

                    @endif

                </ul>
            </div>
        </div>
