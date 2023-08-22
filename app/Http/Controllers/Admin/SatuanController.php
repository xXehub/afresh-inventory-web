<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\SatuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SatuanController extends Controller
{
    public function index()
    {
        $data["title"] = "Satuan";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Satuan', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.Satuan.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = SatuanModel::orderBy('satuan_id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ket', function ($row) {
                    $ket = $row->satuan_keterangan == '' ? '-' : $row->satuan_keterangan;

                    return $ket;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "satuan_id" => $row->satuan_id,
                        "satuan_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->satuan_nama)),
                        "satuan_keterangan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->satuan_keterangan))
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Satuan', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Satuan', 'tbl_akses.akses_type' => 'delete'))->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else {
                        $button .= '-';
                    }
                    return $button;
                })
                ->rawColumns(['action', 'ket'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan)));

        //insert data
        SatuanModel::create([
            'satuan_nama' => $request->satuan,
            'satuan_slug' => $slug,
            'satuan_keterangan'   => $request->ket,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, SatuanModel $satuan)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan)));

        //update data
        $satuan->update([
            'satuan_nama' => $request->satuan,
            'satuan_slug' => $slug,
            'satuan_keterangan'  => $request->ket,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, SatuanModel $satuan)
    {
        //delete
        $satuan->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
