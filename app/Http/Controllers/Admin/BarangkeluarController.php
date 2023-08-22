<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $data["title"] = "Barang Keluar";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang Keluar', 'tbl_akses.akses_type' => 'create'))->count();
        return view('Admin.BarangKeluar.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->orderBy('bk_id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl', function ($row) {
                    $tgl = $row->bk_tanggal == '' ? '-' : Carbon::parse($row->bk_tanggal)->translatedFormat('d F Y');

                    return $tgl;
                })
                ->addColumn('tujuan', function ($row) {
                    $tujuan = $row->bk_tujuan == '' ? '-' : $row->bk_tujuan;

                    return $tujuan;
                })
                ->addColumn('barang', function ($row) {
                    $barang = $row->barang_id == '' ? '-' : $row->barang_nama;

                    return $barang;
                })
                ->addColumn('action', function ($row) {
                    $array = array(
                        "bk_id" => $row->bk_id,
                        "bk_kode" => $row->bk_kode,
                        "barang_kode" => $row->barang_kode,
                        "bk_tanggal" => $row->bk_tanggal,
                        "bk_tujuan" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->bk_tujuan)),
                        "bk_jumlah" => $row->bk_jumlah
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang Keluar', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang Keluar', 'tbl_akses.akses_type' => 'delete'))->count();
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
                ->rawColumns(['action', 'tgl', 'tujuan', 'barang'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {

        //insert data
        BarangkeluarModel::create([
            'bk_tanggal' => $request->tglkeluar,
            'bk_kode' => $request->bkkode,
            'barang_kode' => $request->barang,
            'bk_tujuan'   => $request->tujuan,
            'bk_jumlah'   => $request->jml,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_ubah(Request $request, BarangkeluarModel $barangkeluar)
    {
        //update data
        $barangkeluar->update([
            'bk_tanggal' => $request->tglkeluar,
            'bk_kode' => $request->bkkode,
            'barang_kode' => $request->barang,
            'bk_tujuan'   => $request->tujuan,
            'bk_jumlah'   => $request->jml,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, BarangkeluarModel $barangkeluar)
    {
        //delete
        $barangkeluar->delete();

        return response()->json(['success' => 'Berhasil']);
    }

}
