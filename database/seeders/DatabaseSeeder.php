<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin_akademik']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'admin_redaksi']);

        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Pesantren',
            'email' => 'admin@mathaliul.com',
            'password' => Hash::make('password123'), // Password login nanti
        ])->assignRole('super_admin');

        // 2. Buat Data Halaman Statis
        $pages = [
            ['key' => 'sejarah', 'title' => 'Sejarah Pesantren', 'content' => 'Pondok ini berdiri tahun...'],
            ['key' => 'visi-misi', 'title' => 'Visi & Misi', 'content' => 'Visi kami adalah...'],
            ['key' => 'pendiri', 'title' => 'Profil Pendiri', 'content' => 'KH. Pendiri adalah sosok...'],
        ];
        
        foreach($pages as $page) {
            Page::create($page);
        }

        // 3. Buat Contoh Berita
        Post::create([
            'title' => 'Penerimaan Santri Baru Tahun 2025',
            'slug' => 'penerimaan-santri-baru-2025',
            'content' => 'Alhamdulillah telah dibuka pendaftaran...',
            'category' => 'berita'
        ]);
        
        Post::create([
            'title' => 'Puisi Santri: Rindu Ibu',
            'slug' => 'puisi-santri-rindu-ibu',
            'content' => 'Di keheningan malam ini...',
            'category' => 'mading'
        ]);

        // 4. Buat Contoh Guru
        Staff::create(['name' => 'KH. Abdullah', 'position' => 'Pimpinan Pondok']);
        Staff::create(['name' => 'Ust. Ahmad', 'position' => 'Kepala Madrasah']);

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