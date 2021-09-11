<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataRoles = [
            [
                'id' => \App\Models\Role::SUPERADMIN,
                'name' => 'Super Admin'
            ],
            [
                'id' => \App\Models\Role::STAFFHR,
                'name' => 'Staff HR'
            ],
            
            [
                'id' => \App\Models\Role::KARYAWAN,
                'name' => 'Karyawan'
            ],
            
        ];
        \App\Models\Role::insert($dataRoles);
    }
}
