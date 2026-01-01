<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $name, $email, $password, $role;
    public $isEdit = false;
    public $editId;

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->isEdit = false;
        $this->editId = null;
    }

    public function create()
    {
        $this->reset(['name', 'email', 'password', 'role', 'isEdit']);
        // PENTING: Kirim nama modal 'user-modal'
        $this->dispatch('open-modal', name: 'user-modal');

        // $this->resetInput(); // Reset form
        // $this->dispatch('open-modal'); // Kirim sinyal ke frontend untuk buka modal
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->role); // Beri Role

        $this->dispatch('close-modal', name: 'user-modal');
        // $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'User berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name ?? ''; // Ambil role lama
        $this->isEdit = true;
        // $this->dispatch('open-modal'); // Buka modal saat edit
        $this->dispatch('open-modal', name: 'user-modal');
    }

    public function update()
    {
        // Validasi password nullable (kalau kosong berarti gak diganti)
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->editId,
            'role' => 'required'
        ]);

        $user = User::findOrFail($this->editId);
        
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $this->dispatch('close-modal'); // Tutup modal setelah update
        $user->update($data);
        $user->syncRoles($this->role); // Update Role

        $this->resetInput();
        session()->flash('message', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        if($id == 1 || $id == auth()->user->id()) {
            session()->flash('error', 'Tidak bisa menghapus akun sendiri atau Super Admin utama!');
            return;
        }
        User::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.user.index', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all()
        ]);
    }
}