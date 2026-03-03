<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@test.com'], // avoid duplicates
            [
                'name' => 'Super Admin',
                'password' => '123456', // auto-hashed by Admin model mutator
            ]
        );
    }
}
