<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\MenuModel;
use App\Models\Admin\SubmenuModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        $data["title"] = "Menu";
        $data["data"] = MenuModel::orderBy('menu_sort', 'ASC')->get();
        return view('Master.Menu.index', $data);
    }

    public function sortup($sort)
    {
        $data1 = MenuModel::where('menu_sort', '=', $sort)->first();
        $data2 = MenuModel::where('menu_sort', '=', $sort - 1)->first();

        MenuModel::where('menu_id', $data1->menu_id)
            ->update([
                'menu_sort' => $sort - 1
            ]);

        MenuModel::where('menu_id', $data2->menu_id)
            ->update([
                'menu_sort' => $sort
            ]);

        $data["title"] = "Menu";
        //redirect to index
        return redirect()->route('menu.index')->with($data);
    }

    public function sortdown($sort)
    {
        $data1 = MenuModel::where('menu_sort', '=', $sort)->first();
        $data2 = MenuModel::where('menu_sort', '=', $sort + 1)->first();

        MenuModel::where('menu_id', $data1->menu_id)
            ->update([
                'menu_sort' => $sort + 1
            ]);

        MenuModel::where('menu_id', $data2->menu_id)
            ->update([
                'menu_sort' => $sort
            ]);

        $data["title"] = "Menu";
        //redirect to index
        return redirect()->route('menu.index')->with($data);
    }

    public function store(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->judul)));
        $generateID = Carbon::now()->timestamp;

        //create
        MenuModel::create([
            'menu_id' => $generateID,
            'menu_judul' => $request->judul,
            'menu_slug' => $slug,
            'menu_icon' => $request->icon,
            'menu_redirect' => $request->type == 1 ? $request->redirect : '-',
            'menu_sort' => MenuModel::count() + 1,
            'menu_type' => $request->type,
        ]);


        if ($request->type == 2) {
            $object = [];
            $index = 0;
            $sort = 1;
            foreach ($request->subjudul as $sub) {
                $object[] = [
                    'menu_id' => $generateID,
                    'submenu_judul' => $sub,
                    'submenu_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $sub))),
                    'submenu_redirect' => $request->redirectsub[$index++],
                    'submenu_sort' => $sort++,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            SubmenuModel::insert($object);
        }

        $data['title'] = "Menu";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil ditambah!');

        //redirect to index
        return redirect()->route('menu.index')->with($data);
    }

    public function update(Request $request, MenuModel $menu)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->ujudul)));

        //update
        $menu->update([
            'menu_judul' => $request->ujudul,
            'menu_slug' => $slug,
            'menu_icon' => $request->uicon,
            'menu_redirect' => $request->utype == 1 ? $request->uredirect : '-',
            'menu_type' => $request->utype,
        ]);

        if ($request->utype == 2) {
            $object = [];
            $index = 0;
            $sort = 1;
            $getSubmenu = SubmenuModel::where('menu_id', '=', $menu->menu_id)->get();
            if(count($getSubmenu) > 0){
                foreach($getSubmenu as $sb){
                    AksesModel::where('submenu_id', '=', $sb->submenu_id)->delete();
                }
            } 
            SubmenuModel::where('menu_id', '=', $menu->menu_id)->delete();
            foreach ($request->usubjudul as $sub) {
                $object[] = [
                    'menu_id' => $menu->menu_id,
                    'submenu_judul' => $sub,
                    'submenu_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $sub))),
                    'submenu_redirect' => $request->uredirectsub[$index++],
                    'submenu_sort' => $sort++,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            SubmenuModel::insert($object);
        }else{
            SubmenuModel::where('menu_id', '=', $menu->menu_id)->delete();
        }

        $data['title'] = "Menu";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil diubah!');

        //redirect to index
        return redirect()->route('menu.index')->with($data);
    }

    public function hapus(Request $request)
    {
        //delete
        AksesModel::where('menu_id', '=', $request->idmenu)->delete();
        $getSubmenu = SubmenuModel::where('menu_id', '=', $request->idmenu)->get();
        if(count($getSubmenu) > 0){
            foreach($getSubmenu as $sb){
                AksesModel::where('submenu_id', '=', $sb->submenu_id)->delete();
            }
        } 
        MenuModel::findOrFail($request->idmenu)->delete();
        SubmenuModel::where('menu_id', '=', $request->idmenu)->delete();
        $menus = MenuModel::orderBy('menu_sort', 'ASC')->get();
        $no = 1;
        if (count($menus) > 0) {
            foreach ($menus as $m) {
                MenuModel::where('menu_id', $m->menu_id)
                    ->update([
                        'menu_sort' => $no++
                    ]);
            }
        }

        $data['title'] = "Menu";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil dihapus!');

        //redirect to index
        return redirect()->route('menu.index')->with($data);
    }
}
