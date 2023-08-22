<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmenuModel extends Model
{
    use HasFactory;
    protected $table = "tbl_submenu";
    protected $primaryKey = 'submenu_id';
    protected $fillable = [
        'menu_id',
        'submenu_judul',
        'submenu_slug',
        'submenu_redirect',
        'submenu_sort'
    ]; 
}
