<?php

namespace Database\Seeders;

use App\Models\Admin;

use App\Models\User;
use App\Models\UserMail;

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
            RoleSeeder::class,
            PermissionSeeder::class,
            ExperienceSeeder::class,
            PortfolioSeeder::class,
            SkillSeeder::class,
            TechSeeder::class,
        ]);
     
        Admin::create([
            "user_name" => "admin",
            "email" => "admin@admin.com",
            "password" => "admin",
            "code" => "admin",
            "phone" => "01000000000",
            "image" => "testImage"
        ]);

        $mail = UserMail::create([
            "email" => "user@email.com",
            "otp" => 1,
            "verified_at" => now(),
            "exp_date" => now()->addMinutes(10)
        ]);


        $user = User::create([
            "name" => "user",
            "email" => "user@email.com",
            "password" => "user",
            "code" => "user",
            "phone" => "01111111111",   
            "image" => "testImage",
            "status" => 1,
            "email_id" => $mail->id
        ]);


    

        Admin::latest()->first()->assignRole("super_admin");
    }
}
