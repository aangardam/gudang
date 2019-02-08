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
                'name' => 'Vendors',
                'display_name' => 'Vendors',
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
        ];
        $n =1;
        foreach ($user as $key => $value) {
            $user = User::create($value);
            $user->attachRole($n);
            $n++;
        }
    }
}
