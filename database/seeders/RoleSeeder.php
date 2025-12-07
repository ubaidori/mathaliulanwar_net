<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role
        $roleSuperAdmin = Role::create(['name' => 'super_admin']);
        $roleAkademik = Role::create(['name' => 'admin_akademik']);
        $roleGuru = Role::create(['name' => 'guru']);
        $roleRedaksi = Role::create(['name' => 'admin_redaksi']);

        // 2. Assign Role ke User yang SUDAH ADA (User pertama Anda)
        // Ganti ID 1 dengan ID user Anda jika berbeda
        $user = User::find(1); 
        if($user) {
            $user->assignRole('super_admin');
        }

        // 3. (Opsional) Buat User Dummy untuk tes
        // User Guru
        $guru = User::create([
            'name' => 'Ustadz Ahmad',
            'email' => 'guru@ponpes.com',
            'password' => bcrypt('password'),
        ]);
        $guru->assignRole('guru');

        // User Akademik
        $akademik = User::create([
            'name' => 'Staff TU',
            'email' => 'tu@ponpes.com',
            'password' => bcrypt('password'),
        ]);
        $akademik->assignRole('admin_akademik');
    }
}