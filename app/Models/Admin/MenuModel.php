<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = "tbl_menu";
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_id',
        'menu_judul',
        'menu_slug',
        'menu_icon',
        'menu_redirect',
        'menu_sort',
        'menu_type'
    ]; 
}
