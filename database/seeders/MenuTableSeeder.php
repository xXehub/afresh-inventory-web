<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_menu')->insert(
            [
                [
                    'menu_id' => '1667444041',
                    'menu_judul' => 'Dashboard',
                    'menu_slug' => 'dashboard',
                    'menu_icon' => 'home',
                    'menu_redirect' => '/dashboard',
                    'menu_sort' => 1,
                    'menu_type' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]
        );
    }
}
