<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'email' => 'admin@mail.com',
            'name' => 'Admin Amal',
            'epf' => '0000',
            'role' => '5',
            'password' => Hash::make('admin@mail.com'),
        ]);
    }
}
