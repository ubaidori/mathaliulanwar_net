<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Page;
use App\Models\Staff;
use App\Models\Dorm;
use App\Models\IslamicClass;
use App\Models\Santri;
use App\Models\AcademicYear;
use App\Models\Subject;
use App\Models\Schedule;
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

        // --- 2. ASRAMA (DORMS) ---
        $dormA = Dorm::create(['block' => 'A', 'room_number' => 101, 'capacity' => 10, 'zone' => 'putra']);
        $dormB = Dorm::create(['block' => 'B', 'room_number' => 201, 'capacity' => 15, 'zone' => 'putri']);
        $dormC = Dorm::create(['block' => 'C', 'room_number' => 102, 'capacity' => 10, 'zone' => 'putra']);

        // --- 3. KELAS DINIYAH ---
        $class1A = IslamicClass::create(['name' => 'Awwaliyah', 'class' => '1', 'sub_class' => 'A']);
        $class1B = IslamicClass::create(['name' => 'Awwaliyah', 'class' => '1', 'sub_class' => 'B']);
        $class2A = IslamicClass::create(['name' => 'Wustho', 'class' => '2', 'sub_class' => 'A']);

        echo "3. Membuat Data Staff & Guru...\n";

        // --- 4. STAFF / GURU (Data Induk) ---
        $staff1 = Staff::create(['name' => 'Ust. Ubaidillah', 'position' => 'Pimpinan Pondok', 'nip' => '19800101', 'is_active' => true]);
        $staff2 = Staff::create(['name' => 'Ustadz Ardianhu', 'position' => 'Guru Nahwu', 'nip' => '19900202', 'is_active' => true]); // Linked logic to guruUser
        $staff3 = Staff::create(['name' => 'Ustadzah Zaidah', 'position' => 'Guru Fiqih', 'nip' => '19950303', 'is_active' => true]);

        // --- 5. DATA SANTRI ---
        // Santri 1 (Lengkap)
        Santri::create([
            'nis' => 1001,
            'nisn' => 3301001,
            'name' => 'Muhammad Rizki',
            'gender' => 'L',
            'address' => 'Jl. Merdeka No. 1, Jakarta',
            'dob' => '2010-05-15',
            'th_child' => 1,
            'siblings_count' => 2,
            'education' => 'SD IT',
            'registration_date' => '2023-07-15',
            'dorm_id' => $dormA->id,
            'islamic_class_id' => $class1A->id,
            'father_name' => 'Budi Santoso',
            'father_job' => 'Wiraswasta',
            'father_phone' => '08123456789',
            'father_alive' => 'Hidup',
            'mother_name' => 'Siti Aminah',
            'mother_job' => 'Ibu Rumah Tangga',
            'mother_alive' => 'Hidup',
        ]);

        // Santri 2 (Putri)
        Santri::create([
            'nis' => 1002,
            'nisn' => 3301002,
            'name' => 'Aisyah Humaira',
            'gender' => 'P',
            'address' => 'Jl. Sudirman No. 5, Bandung',
            'dob' => '2011-02-20',
            'registration_date' => '2023-07-15',
            'dorm_id' => $dormB->id,
            'islamic_class_id' => $class1A->id, // Sekelas dengan Rizki
            'father_name' => 'Hendra',
            'father_alive' => 'Meninggal',
            'mother_name' => 'Rina',
            'mother_alive' => 'Hidup',
        ]);
        
        // Buat 10 santri dummy tambahan
        for ($i = 3; $i <= 12; $i++) {
            Santri::create([
                'nis' => 1000 + $i,
                'name' => 'Santri Dummy ' . $i,
                'gender' => $i % 2 == 0 ? 'L' : 'P',
                'dob' => '2010-01-01',
                'dorm_id' => $i % 2 == 0 ? $dormA->id : $dormB->id,
                'islamic_class_id' => $class1A->id, // Masukkan semua ke kelas 1A agar mudah tes absen
                'registration_date' => now(),
            ]);
        }

        echo "5. Membuat Data Akademik (Tahun, Mapel, Jadwal)...\n";

        // --- 6. AKADEMIK ---
        // Tahun Ajaran
        $year = AcademicYear::create(['name' => '2024/2025', 'semester' => 'Ganjil', 'is_active' => true]);
        AcademicYear::create(['name' => '2023/2024', 'semester' => 'Genap', 'is_active' => false]);

        // Mapel
        $mapel1 = Subject::create(['name' => 'Nahwu Jurumiyah', 'code' => 'NHW', 'description' => 'Tata bahasa arab dasar']);
        $mapel2 = Subject::create(['name' => 'Fiqih Safinah', 'code' => 'FQH', 'description' => 'Hukum islam dasar']);
        $mapel3 = Subject::create(['name' => 'Tauhid Aqidatul Awam', 'code' => 'THD']);

        // Jadwal (Penting untuk Tes Absen)
        // Jadwal 1: Senin, Nahwu, Kelas 1A, Guru Abdullah
        Schedule::create([
            'academic_year_id' => $year->id,
            'islamic_class_id' => $class1A->id,
            'subject_id' => $mapel1->id,
            'staff_id' => $staff2->id,
            'day' => 'Senin',
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
        ]);

        // Jadwal 2: Senin, Fiqih, Kelas 1A, Guru Fatimah
        Schedule::create([
            'academic_year_id' => $year->id,
            'islamic_class_id' => $class1A->id,
            'subject_id' => $mapel2->id,
            'staff_id' => $staff3->id,
            'day' => 'Senin',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ]);

        // Jadwal 3: Selasa, Tauhid
        Schedule::create([
            'academic_year_id' => $year->id,
            'islamic_class_id' => $class1A->id,
            'subject_id' => $mapel3->id,
            'staff_id' => $staff2->id,
            'day' => 'Selasa',
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
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

        // 2. Assign Role ke User yang SUDAH ADA (User pertama Anda)
        // Ganti ID 1 dengan ID user Anda jika berbeda
        $user = User::find(1); 
        if($user) {
            $user->assignRole('super_admin');
        }

        echo "1. Membuat Role & User...\n";

        // --- 1. USER GURU ---
        $guruUser = User::create([
            'name' => 'Ustadz Abdullah',
            'email' => 'guru@ponpes.com', // Login pakai ini
            'password' => Hash::make('password'),
        ]);
        $guruUser->assignRole('guru');

        // --- 2. USER STAFF TU (Akademik) ---
        $staffUser = User::create([
            'name' => 'Staff TU',
            'email' => 'tu@ponpes.com', // Login pakai ini
            'password' => Hash::make('password'),
        ]);
        $staffUser->assignRole('admin_akademik');

        // --- 3. USER MEDIA (Redaksi) ---
        $mediaUser = User::create([
            'name' => 'Tim Media',
            'email' => 'media@ponpes.com', // Login pakai ini
            'password' => Hash::make('password'),
        ]);
        $mediaUser->assignRole('admin_redaksi');

        // ... (lanjut ke data master) ...

        echo "3. Membuat Data Staff & Guru...\n";

        // --- LINK STAFF KE USER ---
        // Staff 1: Pimpinan (Tidak punya user login di contoh ini)
        Staff::create([
            'name' => 'KH. Ahmad Dahlan', 
            'position' => 'Pimpinan', 
            'nip' => '001'
        ]);

        // Staff 2: Ustadz Abdullah (PUNYA USER)
        Staff::create([
            'user_id' => $guruUser->id, // <--- INI KUNCINYA
            'email' => $guruUser->email,
            'name' => $guruUser->name, 
            'position' => 'Guru Nahwu', 
            'nip' => '002', 
            'is_active' => true
        ]);
    }
}