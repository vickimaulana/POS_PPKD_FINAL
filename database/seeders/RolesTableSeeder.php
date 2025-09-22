<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Administrator'],
            ['name' => 'Pimpinan'],
            ['name' => 'Kasir'],
        ]);

        User::insert([
            [
                'name' => 'Admin POS',
                'email' => 'adminpos@gmail.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pimpinan POS',
                'email' => 'pimpinanpos@gmail.com',
                'password' => Hash::make('pimpin123'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir POS',
                'email' => 'kasirpos@gmail.com',
                'password' => Hash::make('kasir123'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
