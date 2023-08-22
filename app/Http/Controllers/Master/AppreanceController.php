<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\AppreanceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppreanceController extends Controller
{
    public function index()
    {
        $data["title"] = "Tampilan/Tema";
        $data["data"] = AppreanceModel::where('user_id', '=', Session::get('user')->user_id)->first();
        return view('Master.Appreance.index', $data);
    }

    public function update($setting, Request $request)
    {
        $checkUser = AppreanceModel::where('user_id', '=', Session::get('user')->user_id)->count();
        if ($checkUser > 0) {
            if ($setting == 'layout') {
                AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                    'appreance_layout' => $request->layout
                ]);
            } else if ($setting == 'theme') {
                if ($request->theme == 'light-mode')
                    AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                        'appreance_theme' => 'light-mode',
                        'appreance_menu' => 'light-menu',
                        'appreance_header' => 'header-light',
                    ]);
                else if ($request->theme == 'dark-mode') {
                    AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                        'appreance_theme' => 'dark-mode',
                        'appreance_menu' => 'dark-menu',
                        'appreance_header' => 'dark-header',
                    ]);
                }
            } else if ($setting == 'menu') {
                AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                    'appreance_menu' => $request->menu
                ]);
            } else if ($setting == 'header') {
                AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                    'appreance_header' => $request->header
                ]);
            }else if ($setting == 'sidestyle') {
                AppreanceModel::where('user_id', Session::get('user')->user_id)->update([
                    'appreance_sidestyle' => $request->sidestyle
                ]);
            }

        } else {
            if ($setting == 'theme') {
                if ($request->theme == 'light-mode') {
                    AppreanceModel::create([
                        'user_id' => Session::get('user')->user_id,
                        'appreance_layout' => 'sidebar-mini',
                        'appreance_theme' => 'light-mode',
                        'appreance_menu' => 'light-menu',
                        'appreance_header' => 'header-light',
                        'appreance_sidestyle' => 'default-menu'
                    ]);
                } else if ($request->theme == 'dark-mode') {
                    AppreanceModel::create([
                        'user_id' => Session::get('user')->user_id,
                        'appreance_layout' => 'sidebar-mini',
                        'appreance_theme' => 'dark-mode',
                        'appreance_menu' => 'dark-menu',
                        'appreance_header' => 'header-dark',
                        'appreance_sidestyle' => 'default-menu'
                    ]);
                }
            } else {
                AppreanceModel::create([
                    'user_id' => Session::get('user')->user_id,
                    'appreance_layout' => $setting == 'layout' ? $request->layout : 'sidebar-mini',
                    'appreance_theme' => $setting == 'theme' ? $request->theme : 'light-mode',
                    'appreance_menu' => $setting == 'menu' ? $request->menu : 'light-menu',
                    'appreance_header' => $setting == 'header' ? $request->header : 'header-light',
                    'appreance_sidestyle' => $setting == 'sidestyle' ? $request->sidestyle : 'default-menu',
                ]);
            }
        }

        $data["title"] = "Tampilan/Tema";
        $data["data"] = AppreanceModel::where('user_id', '=', Session::get('user')->user_id)->first();

        //redirect to index
        return redirect(url('admin/appreance/'))->with($data);
    }
}
