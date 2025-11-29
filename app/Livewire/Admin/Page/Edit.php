<?php

namespace App\Livewire\Admin\Page;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $pageId;
    public $title;
    public $content;
    public $image;      
    public $old_image;

    public function mount($id)
    {
        $page = Page::findOrFail($id);
        $this->pageId = $page->id;
        $this->title = $page->title;
        $this->content = $page->content;
        $this->old_image = $page->image;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
    ];

    public function update()
    {
        $this->validate();
        $page = Page::findOrFail($this->pageId);

        // Logika Upload Gambar
        $imagePath = $this->old_image;
        if ($this->image) {
            if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                Storage::disk('public')->delete($this->old_image);
            }
            $imagePath = $this->image->store('pages', 'public');
        }

        $page->update([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Halaman berhasil diperbarui!');
        return redirect()->route('admin.pages.index');
    }

    public function render()
    {
        return view('livewire.admin.page.edit');
    }
}