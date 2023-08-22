<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppreanceModel extends Model
{
    use HasFactory;
    protected $table = "tbl_appreance";
    protected $primaryKey = 'appreance_id';
    protected $fillable = [
        'user_id',
        'appreance_layout',
        'appreance_theme',
        'appreance_menu',
        'appreance_header',
        'appreance_sidestyle'
    ]; 
}
