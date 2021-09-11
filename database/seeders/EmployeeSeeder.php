<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::factory(100)->create();
        $userEmployes = \App\Models\User::where('role_id', \App\Models\Role::KARYAWAN)->get();

        // $userEmployes->map(function($employe) {
        //     return [
        //         'name' => $employe->name,
        //         'user_id' => $employe->id,
        //         'off_work_total' => rand(12, 60),
        //     ];
        // });
        
        $employes = [];
        
        foreach($userEmployes as $user)
        {
            $employes[] = [
                'name' => $user->name,
                'user_id' => $user->id,
                'off_work_total' => rand(12, 60),
            ];
        }
        
        \App\Models\Employee::insert($employes);
    }
}
