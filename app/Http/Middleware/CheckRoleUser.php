<?php

namespace App\Http\Middleware;

use App\Models\Admin\AksesModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $menu, $type)
    {   
        $getMenu = 1;
        if($type == 'othermenu'){
            $getMenu = AksesModel::where(array('role_id' => Session::get('user')->role_id, 'othermenu_id' => $menu, 'akses_type' => 'view'))->count();
        }else if($type == 'menu'){
            $getMenu = AksesModel::leftJoin('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_akses.menu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_menu.menu_redirect' => $menu, 'tbl_akses.akses_type' => 'view'))->count();
        }else if($type == 'submenu'){
            $getMenu = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_redirect' => $menu, 'tbl_akses.akses_type' => 'view'))->count();
        }
        if($getMenu == 0){
            return abort(404);
        }
        return $next($request);
    }
}
