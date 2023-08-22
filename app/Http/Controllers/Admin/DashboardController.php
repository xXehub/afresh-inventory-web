<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\CustomerModel;
use App\Models\Admin\JenisBarangModel;
use App\Models\Admin\MerkModel;
use App\Models\Admin\RoleModel;
use App\Models\Admin\SatuanModel;
use App\Models\Admin\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data["title"] = "Dashboard";
        $data["jenis"] = JenisBarangModel::orderBy('jenisbarang_id', 'DESC')->count();
        $data["satuan"] = SatuanModel::orderBy('satuan_id', 'DESC')->count();
        $data["merk"] = MerkModel::orderBy('merk_id', 'DESC')->count();
        $data["barang"] = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')->orderBy('barang_id', 'DESC')->count();
        $data["customer"] = CustomerModel::orderBy('customer_id', 'DESC')->count();
        $data["bm"] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangmasuk.barang_kode')->leftJoin('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_barangmasuk.customer_id')->orderBy('bm_id', 'DESC')->count();
        $data["bk"] = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_kode', '=', 'tbl_barangkeluar.barang_kode')->orderBy('bk_id', 'DESC')->count();
        $data["user"] = UserModel::leftJoin('tbl_role', 'tbl_role.role_id', '=', 'tbl_user.role_id')->select()->orderBy('user_id', 'DESC')->count();
        return view('Admin.Dashboard.index', $data);
    }
}
