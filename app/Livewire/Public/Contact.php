<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Message; // Pastikan Model Message di-import

#[Layout('components.layouts.guest')]
class Contact extends Component
{
    // Properti untuk Form
    public $name;
    public $email;
    public $phone;
    public $message;

    // Aturan Validasi
    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|numeric', // Opsional
        'message' => 'required|string|min:10',
    ];

    public function kirimPesan()
    {
        // 1. Validasi Input
        $this->validate();

        // 2. Simpan ke Database
        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        // 3. Reset Form & Kirim Pesan Sukses
        $this->reset(); 
        session()->flash('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }

    public function render()
    {
        return view('livewire.public.contact');
    }
}