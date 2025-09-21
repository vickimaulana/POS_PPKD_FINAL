<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            CategoryProductSeeder::class,
            TransactionSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin POS',
            'email' => 'adminpos@gmail.co',
            'password' => bcrypt('admin123'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Pimpinan POS',
            'email' => 'pimpinanpos@gmail.co',
            'password' => bcrypt('pimpinan123'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Kasir POS',
            'email' => 'kasirpos@gmail.co',
            'password' => bcrypt('kasir123'),
            'role_id' => 3,
        ]);
    }
}
