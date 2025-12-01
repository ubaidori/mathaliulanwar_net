<?php

namespace App\Livewire\Public\Berita;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

#[Layout('components.layouts.guest')]
class Show extends Component
{
    public $post;

    public function mount($slug)
    {
        // Cari berita berdasarkan slug, jika tidak ketemu munculkan 404
        $this->post = Post::where('slug', $slug)
                        ->where('is_published', true)
                        ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.berita.show');
    }
}