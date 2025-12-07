<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use App\Models\Santri;

class Show extends Component
{
    public $santri;

    public function mount($id)
    {
        // Ambil data santri beserta relasi asrama & kelas (jika ada)
        // Kita gunakan findOrFail agar jika ID salah, muncul 404
        $this->santri = Santri::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.santri.show');
    }
}