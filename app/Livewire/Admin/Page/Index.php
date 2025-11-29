<?php

namespace App\Livewire\Admin\Page;

use Livewire\Component;
use App\Models\Page;

class Index extends Component
{
    public function render()
    {
        // Ambil semua halaman statis
        return view('livewire.admin.page.index', [
            'pages' => Page::all()
        ]);
    }
}