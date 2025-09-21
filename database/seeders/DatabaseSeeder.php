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
        $this->call([RolesTableSeeder::class, CategoryProductSeeder::class, TransactionSeeder::class]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminpos@gmail.co',
            'password' => 'admin123',
            'role_id' => 1,
        ]);
    }
}
