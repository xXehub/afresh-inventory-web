<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <!-- <a class="logo-horizontal d-flex justify-center" href="index.html">
                <img src="../assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="../assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
            </a> -->
            <a class="logo-horizontal" href="{{url('/')}}">
                <div class="header-brand-img desktop-logo">
                    <div class="d-flex justify-content-center align-items-center">
                        @if($web->web_logo == '' || $web->web_logo == 'default.png')
                        <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="me-1" alt="logo">
                        @else
                        <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="me-1" alt="logo">
                        @endif
                        <h4 class="fw-bold mt-4 text-white text-uppercase text-truncate">{{$web->web_nama}}</h4>
                    </div>
                </div>
                <div class="header-brand-img light-logo1">
                    <div class="d-flex justify-content-center align-items-center">
                        @if($web->web_logo == '' || $web->web_logo == 'default.png')
                        <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="me-1" alt="logo">
                        @else
                        <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="me-1" alt="logo">
                        @endif
                        <h4 class="fw-bold mt-4 text-black text-uppercase text-truncate">{{$web->web_nama}}</h4>
                    </div>
                </div>
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex justify-content-between order-lg-2">
                            <!-- Theme-Layout -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->
                            <div class="dropdown d-none notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span class=" pulse-danger"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                <i class="fe fe-mail"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New Application received
                                                </h5>
                                                <span class="notification-subtext">3 days ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                <i class="fe fe-check-circle"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Project has been
                                                    approved</h5>
                                                <span class="notification-subtext">2 hours ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                                                <i class="fe fe-shopping-cart"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Your Product Delivered
                                                </h5>
                                                <span class="notification-subtext">30 min ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="notify-list.html">
                                            <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                                <i class="fe fe-user-plus"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">Friend Requests</h5>
                                                <span class="notification-subtext">1 day ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="notify-list.html" class="dropdown-item text-center p-3 text-muted">View all
                                        Notification</a>
                                </div>
                            </div>

                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <div class="text-end">
                                        <h5 class="text-dark mb-0 me-4 fs-14 fw-semibold">{{Session::get('user')->user_nmlengkap}}</h5>
                                        <small class="text-muted me-4">{{Session::get('user')->role_title}}</small>
                                    </div>
                                    @if(Session::get('user')->user_foto == 'undraw_profile.svg')
                                    <img src="{{url('/assets/default/users/undraw_profile.svg')}}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                    @else
                                    <img class="avatar profile-user brround cover-image" src="{{asset('storage/users/'.Session::get('user')->user_foto)}}" alt="avatar">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <!-- <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{Session::get('user')->user_nmlengkap}}</h5>
                                            <small class="text-muted">{{Session::get('user')->role_title}}</small>
                                        </div>
                                    </div> -->
                                    <!-- <div class="dropdown-divider m-0"></div> -->
                                    <a class="dropdown-item" href="{{url('/admin/profile')}}/{{Session::get('user')->user_id}}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{url('/admin/appreance')}}">
                                        <i class="dropdown-icon fe fe-layout"></i> Tampilan / Tema
                                    </a>
                                    <a class="dropdown-item" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modalLogout">
                                        <i class="dropdown-icon fe fe-log-out"></i> Log out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /app-Header -->