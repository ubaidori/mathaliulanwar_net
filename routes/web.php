<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;

// 1. Route Public (Bisa diakses siapa saja)
Route::get('/', Home::class)->name('home');

// 2. Route Guest (Hanya untuk yang BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

// 3. Route Admin (Hanya untuk yang SUDAH login)
Route::middleware('auth')->prefix('admin')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    
    // Nanti kita tambah route Berita, Guru, dll di sini
    Route::get('/berita', App\Livewire\Admin\Post\Index::class)->name('admin.posts.index');
    Route::get('/berita/tambah', App\Livewire\Admin\Post\Create::class)->name('admin.posts.create');
    Route::get('/berita/{id}/edit', App\Livewire\Admin\Post\Edit::class)->name('admin.posts.edit');

    // Route Logout (Pakai Controller sederhana atau closure)
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

