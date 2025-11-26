<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithFileUploads; // Wajib untuk upload file
use App\Models\Post;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $category = 'berita'; // Default
    public $image;

    protected $rules = [
        'title' => 'required|min:5',
        'content' => 'required',
        'category' => 'required|in:berita,mading',
        'image' => 'nullable|image|max:2048', // Max 2MB
    ];

    public function save()
    {
        $this->validate();

        // Upload Gambar jika ada
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('posts', 'public');
        }

        // Simpan ke Database
        Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'category' => $this->category,
            'image' => $imagePath,
            'is_published' => true
        ]);

        session()->flash('message', 'Berita berhasil ditambahkan!');
        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.post.create');
    }
}
