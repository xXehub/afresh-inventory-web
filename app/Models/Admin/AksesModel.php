<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesModel extends Model
{
    use HasFactory;
    protected $table = "tbl_akses";
    protected $primaryKey = 'akses_id';
    protected $fillable = [
        'menu_id',
        'submenu_id',
        'othermenu_id',
        'role_id',
        'akses_type'
    ]; 
}
