 <?php

    use App\Models\Admin\AksesModel;
    use App\Models\Admin\MenuModel;
    use App\Models\Admin\SubmenuModel;
    use Illuminate\Support\Facades\Session;

    $menu = MenuModel::orderBy('menu_sort', 'ASC')->get();
    ?>
 <!--APP-SIDEBAR-->
 <div class="sticky">
     <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
     <div class="app-sidebar">
         <div class="side-header">
             <a class="header-brand1" href="{{url('/admin')}}">
                 @if($web->web_logo == '' || $web->web_logo == 'default.png')
                 <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="header-brand-img toggle-logo" alt="logo">
                 <div class="header-brand-img desktop-logo">
                     <div class="d-flex align-items-center">
                         <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="me-1" alt="logo">
                         <h4 class="fw-bold mt-4 text-white text-uppercase text-truncate">{{$web->web_nama}}</h4>
                     </div>
                 </div>
                 <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="header-brand-img light-logo" alt="logo">
                 <div class="header-brand-img light-logo1">
                     <div class="d-flex align-items-center">
                         <img src="{{url('/assets/default/web/default.png')}}" height="40px" class="me-1" alt="logo">
                         <h4 class="fw-bold mt-4 text-black text-uppercase text-truncate">{{$web->web_nama}}</h4>
                     </div>
                 </div>
                 @else
                 <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="header-brand-img toggle-logo" alt="logo">
                 <div class="header-brand-img desktop-logo">
                     <div class="d-flex align-items-center">
                         <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="me-1" alt="logo">
                         <h4 class="fw-bold mt-4 text-white text-uppercase text-truncate">{{$web->web_nama}}</h4>
                     </div>
                 </div>
                 <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="header-brand-img light-logo" alt="logo">
                 <div class="header-brand-img light-logo1">
                     <div class="d-flex align-items-center">
                         <img src="{{asset('storage/web/' . $web->web_logo)}}" height="40px" class="me-1" alt="logo">
                         <h4 class="fw-bold mt-4 text-black text-uppercase text-truncate">{{$web->web_nama}}</h4>
                     </div>
                 </div>
                 @endif
             </a>
             <!-- LOGO -->
         </div>
         <div class="main-sidemenu">
             <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                 </svg></div>
             <ul class="side-menu">
                 @if(count($menu) > 0)
                 <li class="sub-category">
                     <h3>Menu</h3>
                 </li>
                 @endif
                 @foreach($menu as $m)
                 <?php $getMenu = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'menu_id' => $m->menu_id, 'akses_type' => 'view'))->count(); ?>
                 @if($m->menu_type == 1)
                 @if($getMenu > 0)
                 <li class="slide">
                     <a class="side-menu__item {{$title == $m->menu_judul ? 'active' : ''}}" data-bs-toggle="slide" href="{{url('/admin').$m->menu_redirect}}"><i class="side-menu__icon fe fe-{{$m->menu_icon}}"></i><span class="side-menu__label">{{$m->menu_judul}}</span></a>
                 </li>
                 @endif
                 @elseif($m->menu_type == 2)
                 @if($getMenu > 0)
                 <?php
                    $submenu = SubmenuModel::where('menu_id', '=', $m->menu_id)->orderBy('submenu_sort', 'ASC')->get();
                    $checkMenu = SubmenuModel::join('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_submenu.menu_id')->select()->where(array('tbl_menu.menu_judul' => $m->menu_judul, 'tbl_submenu.submenu_judul' => $title))->count();
                    ?>
                 <li class="slide {{$checkMenu > 0 ? 'is-expanded' : ''}}">
                     <a class="side-menu__item {{$checkMenu > 0 ? 'active' : ''}}" data-bs-toggle="slide" href="javascript:void(0)">
                         <i class="side-menu__icon fe fe-{{$m->menu_icon}}"></i>
                         <span class="side-menu__label">{{$m->menu_judul}}</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                         @foreach($submenu as $sub)
                         <?php $getSubmenu = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'submenu_id' => $sub->submenu_id, 'akses_type' => 'view'))->count(); ?>
                         @if($getSubmenu > 0)
                         <li><a href="{{url('/admin').$sub->submenu_redirect}}" class="slide-item {{$title == $sub->submenu_judul ? 'active' : ''}}">{{$sub->submenu_judul}}</a></li>
                         @endif
                         @endforeach
                     </ul>
                 </li>
                 @endif
                 @endif
                 @endforeach

                 <li class="sub-category">
                     <h3>Other</h3>
                 </li>

                 <?php $getSetting = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 1, 'akses_type' => 'view'))->count(); ?>
                 <?php $getSettingMenu = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 2, 'akses_type' => 'view'))->count(); ?>
                 <?php $getSettingRole = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 3, 'akses_type' => 'view'))->count(); ?>
                 <?php $getSettingUser = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 4, 'akses_type' => 'view'))->count(); ?>
                 <?php $getSettingAkses = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 5, 'akses_type' => 'view'))->count(); ?>
                 <?php $getSettingWeb = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => 6, 'akses_type' => 'view'))->count(); ?>

                 @if($getSetting > 0)
                 <li class="slide {{$title == 'Menu' || $title == 'Role' || $title == 'User' || $title == 'Akses' || $title == 'Web' ? 'is-expanded' : ''}}">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                         <i class="side-menu__icon fe fe-settings"></i>
                         <span class="side-menu__label">Settings</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                         @if($getSettingMenu > 0)
                         <li><a href="{{url('/admin/menu')}}" class="slide-item {{$title == 'Menu' ? 'active' : ''}}">Menu</a></li>
                         @endif
                         <li class="sub-slide {{$title == 'Role' || $title == 'User' || $title == 'Akses' ? 'is-expanded' : ''}}">
                             <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">User</span><i class="sub-angle fe fe-chevron-right"></i></a>
                             <ul class="sub-slide-menu">
                                 @if($getSettingRole > 0)
                                 <li><a class="sub-slide-item {{$title == 'Role' ? 'active' : ''}}" href="{{url('/admin/role')}}">Role</a></li>
                                 @endif
                                 @if($getSettingUser > 0)
                                 <li><a class="sub-slide-item {{$title == 'User' ? 'active' : ''}}" href="{{url('/admin/user')}}">List</a></li>
                                 @endif
                                 @if($getSettingAkses > 0)
                                 <li><a class="sub-slide-item {{$title == 'Akses' ? 'active' : ''}}" href="{{url('/admin/akses/role')}}">Akses</a></li>
                                 @endif
                             </ul>
                         </li>
                         @if($getSettingWeb > 0)
                         <li><a href="{{url('/admin/web')}}" class="slide-item {{$title == 'Web' ? 'active' : ''}}">Web</a></li>
                         @endif
                     </ul>
                 </li>
                 @endif


                 <li class="slide">
                     <a class="side-menu__item" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modalLogout"><i class="side-menu__icon fe fe-log-out"></i><span class="side-menu__label">Log Out</span></a>
                 </li>


             </ul>
             <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                 </svg></div>
         </div>
     </div>
     <!--/APP-SIDEBAR-->
 </div>