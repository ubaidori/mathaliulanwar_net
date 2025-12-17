<?php

namespace App\Livewire\Admin\Staff;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Penting untuk Transaction

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $nip, $position, $phone, $photo, $old_photo, $is_active = 1;
    public $email; // Baru
    public $make_account = false; // Checkbox toggle

    public $isEdit = false;
    public $editId;
    public $search = '';

    public function resetInput()
    {
        $this->reset(['name', 'nip', 'position', 'phone', 'photo', 'old_photo', 'is_active', 'email', 'make_account', 'isEdit', 'editId']);
        $this->is_active = 1;
    }

    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'email' => $this->make_account ? 'required|email|unique:users,email' : 'nullable|email',
        ]);

        // Gunakan Transaction agar jika gagal buat user, staff tidak terbuat (bersih)
        DB::transaction(function () {
            
            $userId = null;

            // 1. Jika dicentang, Buat User Baru
            if ($this->make_account) {
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make('password'), // Default password
                ]);
                $user->assignRole('guru'); // Otomatis jadi Guru
                $userId = $user->id;
            }

            // 2. Upload Foto
            $photoPath = $this->photo ? $this->photo->store('staff-photos', 'public') : null;

            // 3. Buat Data Staff
            Staff::create([
                'user_id' => $userId,
                'name' => $this->name,
                'email' => $this->email,
                'nip' => $this->nip,
                'position' => $this->position,
                'phone' => $this->phone,
                'photo' => $photoPath,
                'is_active' => $this->is_active,
            ]);
        });

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Staff berhasil ditambahkan. (Default Pass: password)');
    }

    // ... method edit, update, delete, render (biarkan atau sesuaikan sedikit) ...
    // Pastikan di method render() Anda memuat relasi user: Staff::with('user')...
    public function render()
    {
        $staffs = Staff::with('user') // Eager load agar performa bagus
                    ->where('name', 'like', '%'.$this->search.'%')
                    ->orderBy('name')
                    ->paginate(10);

        return view('livewire.admin.staff.index', ['staffs' => $staffs]);
    }
}