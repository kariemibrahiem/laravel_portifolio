<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            "user_name"=>"kariem",
            "email"=>"kariem2@admin.com",
            "password"=>"kariem123",
            "phone"=>"01022838651",
            "role_id"=>1
        ]);
    }
}
