<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataUsers = [
            [
                'name' => 'superadmin',
                'email' => 'superadmin@admin.com',
                'password' => bcrypt('superadmin'),
                'role_id' => 1,
            ],
            [
                'name' => 'staffhr',
                'email' => 'staffhr@admin.com',
                'password' => bcrypt('staffhr'),
                'role_id' => 2,
            ],
            [
                'name' => 'karyawan1',
                'email' => 'karyawan1@admin.com',
                'password' => bcrypt('karyawan1'),
                'role_id' => 3,
            ],

        ];

        \App\Models\User::insert($dataUsers);
    }
}
