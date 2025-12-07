<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Public\Profil;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});
// Route Kontak
Route::get('/kontak', Contact::class)->name('public.contact');

// 3. Route Admin (Hanya untuk yang SUDAH login)
Route::middleware('auth')->prefix('admin')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

    // ... di dalam group admin
    Route::get('/halaman', App\Livewire\Admin\Page\Index::class)->name('admin.pages.index');
    Route::get('/halaman/{id}/edit', App\Livewire\Admin\Page\Edit::class)->name('admin.pages.edit');
    
    // Route Berita
    Route::get('/berita', App\Livewire\Admin\Post\Index::class)->name('admin.posts.index');
    Route::get('/berita/tambah', App\Livewire\Admin\Post\Create::class)->name('admin.posts.create');
    Route::get('/berita/{id}/edit', App\Livewire\Admin\Post\Edit::class)->name('admin.posts.edit');

    // Route Asrama
    Route::get('/asrama', App\Livewire\Admin\Dorm\Index::class)->name('admin.dorms.index');
    Route::get('/kelas', App\Livewire\Admin\IslamicClass\Index::class)->name('admin.classes.index');

    // Route Santri
    Route::get('/santri', App\Livewire\Admin\Santri\Index::class)->name('admin.santri.index');
    Route::get('/santri/tambah', App\Livewire\Admin\Santri\Create::class)->name('admin.santri.create');
    Route::get('/santri/{id}/edit', App\Livewire\Admin\Santri\Edit::class)->name('admin.santri.edit');
    Route::get('/santri/{id}', App\Livewire\Admin\Santri\Show::class)->name('admin.santri.show');

    // Route Staff
    Route::get('/staff', App\Livewire\Admin\Staff\Index::class)->name('admin.staff.index');

    // Route Academic
    Route::get('/tahun-ajaran', App\Livewire\Admin\Academic\YearIndex::class)->name('admin.academic.year');
    Route::get('/mata-pelajaran', App\Livewire\Admin\Academic\SubjectIndex::class)->name('admin.academic.subject');
    Route::get('/jadwal-pelajaran', App\Livewire\Admin\Academic\ScheduleIndex::class)->name('admin.academic.schedule');

    // Menu Utama Absensi
    Route::get('/absensi', App\Livewire\Admin\Attendance\Index::class)->name('admin.attendance.index');

    // Form Input (Perlu parameter schedule_id dan date)
    Route::get('/absensi/{schedule_id}/{date}', App\Livewire\Admin\Attendance\Create::class)->name('admin.attendance.create');

    // Laporan Absensi
    Route::get('/laporan-absensi', App\Livewire\Admin\Attendance\Report::class)->name('admin.attendance.report');

    // Route Pesan
    Route::get('/pesan', App\Livewire\Admin\Pesan\Index::class)->name('admin.messages.index');
    
    // Route Logout (Pakai Controller sederhana atau closure)
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

