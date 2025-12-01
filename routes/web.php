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

