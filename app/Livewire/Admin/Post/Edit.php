<?php

namespace App\Livewire\Admin\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus foto lama

class Edit extends Component
{
    use WithFileUploads;

    public $postId;
    public $title;
    public $writer;
    public $content;
    public $category;
    public $image;      // Untuk menampung upload baru
    public $old_image;  // Untuk menyimpan path gambar lama

    // Lifecycle Hook: Jalan pertama kali saat komponen dimuat
    public function mount($id)
    {
        $post = Post::findOrFail($id);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->writer = $post->writer;
        $this->content = $post->content;
        $this->category = $post->category;
        $this->old_image = $post->image;
    }

    protected $rules = [
        'title' => 'required|min:5',
        'writer' => 'required|string|max:50',
        'content' => 'required',
        'category' => 'required|in:berita,mading',
        'image' => 'nullable|image|max:2048', // Nullable karena tidak wajib ganti foto
    ];

    public function update()
    {
        $this->validate();

        $post = Post::findOrFail($this->postId);

        // Cek apakah user mengupload gambar baru
        if ($this->image) {
            // 1. Hapus gambar lama jika ada
            if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                Storage::disk('public')->delete($this->old_image);
            }
            
            // 2. Upload gambar baru
            $imagePath = $this->image->store('posts', 'public');
        } else {
            // Jika tidak upload, pakai gambar lama
            $imagePath = $this->old_image;
        }

        // Update Database
        $post->update([
            'title' => $this->title,
            'writer' => $this->writer,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'category' => $this->category,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Berita berhasil diperbarui!');
        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.post.edit');
    }
}