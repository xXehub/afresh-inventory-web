<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarangModel extends Model
{
    use HasFactory;
    protected $table = "tbl_jenisbarang";
    protected $primaryKey = 'jenisbarang_id';
    protected $fillable = [
        'jenisbarang_nama',
        'jenisbarang_slug',
        'jenisbarang_ket'
    ]; 
}
