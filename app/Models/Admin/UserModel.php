<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = "tbl_user";
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'role_id',
        'user_nama',
        'user_nmlengkap',
        'user_email',
        'user_password',
        'user_foto',
    ];
}
