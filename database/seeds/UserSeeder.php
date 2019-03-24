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
                'name' => 'Staff Gudang',
                'display_name' => 'Staff Gudang',
            ],
            [
                'name' => 'Kepala Toko',
                'display_name' => 'Kepala Toko',
            ],
            [
                'name' => 'Kepala Gudang',
                'display_name' => 'Kepala Gudang',
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
                'name' => 'Staff Gudang',
                'email' => 'staf_gudang@sixpax.com',
                'password' => bcrypt('123'),
                'role_id' => 1
            ],
            [
                'name' => 'Kepala Toko',
                'email' => 'kepala_toko@sixpax.com',
                'password' => bcrypt('123'),
                'role_id' => 2
            ],
            [
                'name' => 'Kepala Gudang',
                'email' => 'kepala_gudang@sixpax.com',
                'password' => bcrypt('123'),
                'role_id' => 3
            ]
        ];
        $n =1;
        foreach ($user as $key => $value) {
            $user = User::create($value);
            $user->attachRole($n);
            $n++;
        }
    }
}
