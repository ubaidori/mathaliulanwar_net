<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Santri;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $santris = Santri::where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('nis', 'like', '%'.$this->search.'%')
                    ->latest()
                    ->paginate(10);

        return view('livewire.admin.santri.index', [
            'santris' => $santris
        ]);
    }

    public function delete($id)
    {
        $santri = Santri::find($id);
        if($santri) {
            $santri->delete();
            session()->flash('message', 'Data santri berhasil dihapus.');
        }
    }
}