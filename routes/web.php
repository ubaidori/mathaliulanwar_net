<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Public\Profil;
use App\Livewire\Admin\Attendance\TeacherReport;
use App\Livewire\Admin\User\Index as UserIndex;
use App\Livewire\Admin\Santri\Index as SantriIndex;
use App\Livewire\Public\Berita\Index as BeritaIndex;
use App\Livewire\Public\Berita\Show as BeritaShow;
use App\Livewire\Public\Contact;

// 1. Route Public (Bisa diakses siapa saja)
Route::get('/', Home::class)->name('home');
Route::get('/profil/{key}', Profil::class)->name('public.profil');  // Profil dinamis berdasarkan key

// Route Berita
Route::get('/berita', BeritaIndex::class)->name('public.berita.index');
Route::get('/berita/{slug}', BeritaShow::class)->name('public.berita.show');
// 2. Route Guest (Hanya untuk yang BELUM login)
Route::get('/login', Login::class)->name('login');
// Route Kontak
Route::get('/kontak', Contact::class)->name('public.contact');

// Tambahkan middleware role

Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // 1. Dashboard (Bisa diakses Guru, Akademik, Redaksi, Super Admin)
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // 2. Profile / Setting Akun (Jika ada)
    // Route::get('/profile', ...);
}); 

// --- GROUP 2: KHUSUS SUPER ADMIN ---
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->group(function () {
    Route::get('/users', UserIndex::class)->name('admin.users.index');
    // Menu konfigurasi sistem lainnya...
    
    // Route Halaman Profil Statis
    Route::get('/halaman', App\Livewire\Admin\Page\Index::class)->name('admin.pages.index');
    Route::get('/halaman/{id}/edit', App\Livewire\Admin\Page\Edit::class)->name('admin.pages.edit');
    Route::get('/pesan', App\Livewire\Admin\Pesan\Index::class)->name('admin.messages.index');
});

// --- GROUP 3: SUPER ADMIN & AKADEMIK (Data Induk) ---
Route::middleware(['auth', 'role:super_admin|admin_akademik'])->prefix('admin')->group(function () {
    // Masukkan route Santri, Kelas, Asrama, Staff di sini

    // Route Santri
    Route::get('/santri', App\Livewire\Admin\Santri\Index::class)->name('admin.santri.index');
    Route::get('/santri/tambah', App\Livewire\Admin\Santri\Create::class)->name('admin.santri.create');
    Route::get('/santri/{id}/edit', App\Livewire\Admin\Santri\Edit::class)->name('admin.santri.edit');
    Route::get('/santri/{id}', App\Livewire\Admin\Santri\Show::class)->name('admin.santri.show');

    Route::get('/staff', App\Livewire\Admin\Staff\Index::class)->name('admin.staff.index');
    Route::get('/kelas', App\Livewire\Admin\IslamicClass\Index::class)->name('admin.classes.index');
    Route::get('/asrama', App\Livewire\Admin\Dorm\Index::class)->name('admin.dorms.index');
    Route::get('/tahun-ajaran', App\Livewire\Admin\Academic\YearIndex::class)->name('admin.academic.year');
    Route::get('/mata-pelajaran', App\Livewire\Admin\Academic\SubjectIndex::class)->name('admin.academic.subject');
    // Jadwal Pelajaran juga masuk sini (untuk setup)
    Route::get('/jadwal-pelajaran', App\Livewire\Admin\Academic\ScheduleIndex::class)->name('admin.academic.schedule');
    Route::get('/laporan-absensi', App\Livewire\Admin\Attendance\Report::class)->name('admin.attendance.report');
    Route::get('/laporan-guru', TeacherReport::class)->name('admin.attendance.teacher_report');
});

// --- GROUP 4: SUPER ADMIN, AKADEMIK, & GURU (Aktivitas Harian) ---
Route::middleware(['auth', 'role:super_admin|admin_akademik|guru'])->prefix('admin')->group(function () {
    // Guru butuh akses Absensi
    Route::get('/absensi', App\Livewire\Admin\Attendance\Index::class)->name('admin.attendance.index');
    Route::get('/absensi/{schedule_id}/{date}', App\Livewire\Admin\Attendance\Create::class)->name('admin.attendance.create');
});

// --- GROUP 5: SUPER ADMIN & REDAKSI (Konten Website) ---
Route::middleware(['auth', 'role:super_admin|admin_redaksi'])->prefix('admin')->group(function () {
    Route::get('/berita', App\Livewire\Admin\Post\Index::class)->name('admin.posts.index');
    Route::get('/berita/tambah', App\Livewire\Admin\Post\Create::class)->name('admin.posts.create');
    Route::get('/berita/{id}/edit', App\Livewire\Admin\Post\Edit::class)->name('admin.posts.edit');
});
