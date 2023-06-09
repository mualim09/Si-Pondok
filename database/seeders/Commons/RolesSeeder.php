<?php

namespace Database\Seeders\Commons;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
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
                'name' => 'Administrator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'BK',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Guru',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Siswa',
                'guard_name' => 'web'
            ],
        ];

        Role::insert($roles);
    }
}
