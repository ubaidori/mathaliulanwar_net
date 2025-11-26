<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Index extends Component
{
    use WithPagination; // Agar tabel bisa ada halaman 1, 2, 3 dst

    public $search = '';

    public function render()
    {
        // Ambil data berita, urutkan terbaru, filter jika ada pencarian
        $posts = Post::where('title', 'like', '%'.$this->search.'%')
                    ->latest()
                    ->paginate(10);

        return view('livewire.admin.post.index', [
            'posts' => $posts
        ]);
    }

    // Fitur Delete Cepat
    public function delete($id)
    {
        $post = Post::find($id);
        if($post) {
            $post->delete();
            session()->flash('message', 'Berita berhasil dihapus.');
        }
    }
}
