<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Super Admin'
        ]);

        $dentryRole = Role::create([
            'name' => 'dentry',
            'display_name' => 'Data Entry',
            'description' => 'Data Entry Can Add Data Only'
        ]);

        $admin = User::create([
            'name' => 'Ahmed Mohsen',
            'mobile' => '01005785948',
            'password' => Hash::make("secret"),
        ]);

        $admin->addRole($adminRole);

        $admin = User::create([
            'name' => 'Mohamed Mahmoud',
            'mobile' => '01227523010',
            'password' => Hash::make("oza123456"),
        ]);

        $admin->addRole($adminRole);

        $dentry = User::create([
            'name' => 'Secretary',
            'mobile' => '01234567890',
            'password' => Hash::make("123456"),
        ]);

        $dentry->addRole($dentryRole);

        Setting::create([
            'name' => "Physical Therapy"
        ]);
    }
}
