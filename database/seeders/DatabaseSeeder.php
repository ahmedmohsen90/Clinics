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
        // Roles
        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Super Admin'
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin'
        ]);

        $dentryRole = Role::create([
            'name' => 'dentry',
            'display_name' => 'Data Entry',
            'description' => 'Data Entry Can Add Data Only'
        ]);

        // Admins
        $superAdmin = User::create([
            'name' => 'Ahmed Mohsen',
            'mobile' => '01005785948',
            'password' => Hash::make("secret"),
        ]);
        $superAdmin->addRole($superAdminRole);

        $superAdmin = User::create([
            'name' => 'Mohamed Mahmoud',
            'mobile' => '01227523010',
            'password' => Hash::make("oza123456"),
        ]);
        $superAdmin->addRole($superAdminRole);

        $admin = User::create([
            'name' => 'Admin',
            'mobile' => '01234567891',
            'password' => Hash::make("123456"),
        ]);
        $admin->addRole($adminRole);

        Setting::create([
            'name_ar' => "العيادة",
            'name_en' => "Clinics"
        ]);
    }
}
