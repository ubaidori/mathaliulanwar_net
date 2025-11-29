<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Page;

#[Layout('components.layouts.guest')] // Pastikan pakai layout Guest (Navbar)
class Profil extends Component
{
    public $page;
    public $allPages; // Untuk daftar menu di sidebar

    public function mount($key)
    {
        // 1. Ambil Halaman yang sedang dibuka (berdasarkan URL)
        // Jika tidak ada, tampilkan 404 Not Found
        $this->page = Page::where('key', $key)->firstOrFail();

        // 2. Ambil daftar semua halaman profil untuk menu navigasi
        $this->allPages = Page::select('title', 'key')->get();
    }

    public function render()
    {
        return view('livewire.public.profil');
    }
}