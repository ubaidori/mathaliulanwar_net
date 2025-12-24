<?php

namespace App\Livewire\Admin\Pesan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Message;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $pesan = Message::find($id);
        if($pesan) {
            $pesan->delete();
            session()->flash('message', 'Pesan berhasil dihapus.');
        }
    }

    public function markAsRead($id)
    {
        $pesan = Message::find($id);
        if($pesan && $pesan->status == 0) {
            $pesan->status = 1; // Tandai sebagai terbaca
            $pesan->save();
            session()->flash('message', 'Pesan ditandai sebagai terbaca.');
        }
    }

    public function render()
    {
        // Ambil data pesan, urutkan dari yang terbaru
        return view('livewire.admin.pesan.index', [
            'messages' => Message::latest()->paginate(10),
        ]);
    }
}