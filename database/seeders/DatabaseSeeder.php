<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Pesantren',
            'email' => 'admin@mathaliul.com',
            'password' => Hash::make('password123'), // Password login nanti
        ]);

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
    }
}