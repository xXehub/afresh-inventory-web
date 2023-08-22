<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AksesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_akses')->insert(
            [
                // Dashboard akses role Super Admin
                [
                    'menu_id' => '1667444041',
                    'role_id' => 1,
                    'akses_type' => 'view',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 1,
                    'akses_type' => 'create',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 1,
                    'akses_type' => 'update',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 1,
                    'akses_type' => 'delete',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],

                // Dashboard akses role Admin
                [
                    'menu_id' => '1667444041',
                    'role_id' => 2,
                    'akses_type' => 'view',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 2,
                    'akses_type' => 'create',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 2,
                    'akses_type' => 'update',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 2,
                    'akses_type' => 'delete',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],

                // Dashboard akses role Operator
                [
                    'menu_id' => '1667444041',
                    'role_id' => 3,
                    'akses_type' => 'view',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 3,
                    'akses_type' => 'create',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 3,
                    'akses_type' => 'update',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'menu_id' => '1667444041',
                    'role_id' => 3,
                    'akses_type' => 'delete',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],

            ]
        );

        DB::table('tbl_akses')->insert([
            // Settings akses role Super Admin
            [
                'othermenu_id' => 1,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // Settings akses role Admin
            [
                'othermenu_id' => 1,
                'role_id' => 2,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu akses role Super Admin
            [
                'othermenu_id' => 2,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 1,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 1,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 1,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu akses role Admin
            [
                'othermenu_id' => 2,
                'role_id' => 2,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 2,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 2,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 2,
                'role_id' => 2,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu Role akses role Super Admin
            [
                'othermenu_id' => 3,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 1,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 1,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 1,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // Menu Role akses role Admin
            [
                'othermenu_id' => 3,
                'role_id' => 2,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 2,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 2,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 3,
                'role_id' => 2,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // User akses role Super Admin
            [
                'othermenu_id' => 4,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 1,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 1,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 1,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // User akses role Admin
            [
                'othermenu_id' => 4,
                'role_id' => 2,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 2,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 2,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 4,
                'role_id' => 2,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu Akses role Super Admin
            [
                'othermenu_id' => 5,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 5,
                'role_id' => 1,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 5,
                'role_id' => 1,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 5,
                'role_id' => 1,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu Web role Super Admin
            [
                'othermenu_id' => 6,
                'role_id' => 1,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 1,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 1,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 1,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // Menu Web role Admin
            [
                'othermenu_id' => 6,
                'role_id' => 2,
                'akses_type' => 'view',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 2,
                'akses_type' => 'create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 2,
                'akses_type' => 'update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'othermenu_id' => 6,
                'role_id' => 2,
                'akses_type' => 'delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
