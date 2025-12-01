<?php

namespace App\Livewire\Public\Berita;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Post;

#[Layout('components.layouts.guest')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $kategori = ''; // Bisa kosong (semua), 'berita', atau 'mading'

    // Reset halaman ke 1 jika user melakukan pencarian/filter
    public function updatingSearch() { $this->resetPage(); }
    public function updatingKategori() { $this->resetPage(); }

    public function render()
    {
        $posts = Post::where('is_published', true)
            ->when($this->kategori, function($query) {
                $query->where('category', $this->kategori);
            })
            ->where('title', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(9); // Tampilkan 9 berita per halaman

        return view('livewire.public.berita.index', [
            'posts' => $posts
        ]);
    }
}