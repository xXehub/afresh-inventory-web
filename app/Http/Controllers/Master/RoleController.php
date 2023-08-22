<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $data["title"] = "Role";
        return view('Master.Role.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = RoleModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $array = array(
                        "role_id" => $row->role_id,
                        "role_title" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->role_title)),
                        "role_desc" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->role_desc))
                    );
                    $button = '';
                    $button .= '
                    <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update('.json_encode($array).')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus('.json_encode($array).')><span class="fe fe-trash-2 fs-14"></span></a>
                    </div>
                    ';
                    return $button;
                })
                ->rawColumns(['action'])->make(true);
        }
    }

    public function store(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        //create
        RoleModel::create([
            'role_title' => $request->title,
            'role_slug' => $slug,
            'role_desc' => $request->desc
        ]);

        $data['title'] = "Role";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil ditambah!');

        //redirect to index
        return redirect()->route('role.index')->with($data);
    }

    public function update(Request $request, RoleModel $role)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->utitle)));

        //update
        $role->update([
            'role_title' => $request->utitle,
            'role_slug' => $slug,
            'role_desc' => $request->udesc
        ]);

        $data['title'] = "Role";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil diubah!');

        //redirect to index
        return redirect()->route('role.index')->with($data);
    }

    public function hapus(Request $request)
    {
        //delete
        RoleModel::findOrFail($request->idrole)->delete();
        AksesModel::where('role_id', '=', $request->idrole)->delete();

        $data['title'] = "Role";
        Session::flash('status', 'success');
        Session::flash('msg', 'Berhasil dihapus!');

        //redirect to index
        return redirect()->route('role.index')->with($data);
    }
}
