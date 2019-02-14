<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'display_name' => 'Administator',
            ],
            [
                'name' => 'Kepala Toko',
                'display_name' => 'Kepala Toko',
            ],
            [
                'name' => 'Staff Gudang',
                'display_name' => 'Staff Gudang',
            ],
            [
                'name' => 'Vendor',
                'display_name' => 'Vendor',
            ]
        ];
        foreach ($roles as $key => $value) {
            Role::create($value);
        }
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@local.local',
                'password' => bcrypt('123'),
                'role_id' => 1
            ],
            [
                'name' => 'toko',
                'email' => 'toko@local.local',
                'password' => bcrypt('123'),
                'role_id' => 2
            ],
        ];
        $n =1;
        foreach ($user as $key => $value) {
            $user = User::create($value);
            $user->attachRole($n);
            $n++;
        }
    }
}
