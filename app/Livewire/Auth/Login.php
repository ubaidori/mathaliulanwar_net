<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.auth')] // Gunakan layout auth yang baru kita buat
class Login extends Component
{
    public $email;
    public $password;

    // Aturan Validasi
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function authenticate()
    {
        $this->validate();

        // Coba Login
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Jika sukses, regenerasi sesi (keamanan) dan alihkan ke dashboard
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal
        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
