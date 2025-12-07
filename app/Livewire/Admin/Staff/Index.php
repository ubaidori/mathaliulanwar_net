<?php

namespace App\Livewire\Admin\Staff;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Import untuk upload foto
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Properti Data
    public $name, $nip, $position, $phone, $photo, $old_photo, $is_active = 1;
    
    // Properti State
    public $isEdit = false;
    public $editId;
    public $search = '';

    public function resetInput()
    {
        $this->name = '';
        $this->nip = '';
        $this->position = '';
        $this->phone = '';
        $this->photo = null;
        $this->old_photo = null;
        $this->is_active = 1;
        $this->isEdit = false;
        $this->editId = null;
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
            'photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('staff-photos', 'public');
        }

        Staff::create([
            'name' => $this->name,
            'nip' => $this->nip,
            'position' => $this->position,
            'phone' => $this->phone,
            'photo' => $photoPath,
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Data staff berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $this->editId = $id;
        $this->name = $staff->name;
        $this->nip = $staff->nip;
        $this->position = $staff->position;
        $this->phone = $staff->phone;
        $this->old_photo = $staff->photo;
        $this->is_active = $staff->is_active;
        
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        $staff = Staff::findOrFail($this->editId);
        $photoPath = $staff->photo;

        if ($this->photo) {
            // Hapus foto lama
            if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
                Storage::disk('public')->delete($staff->photo);
            }
            $photoPath = $this->photo->store('staff-photos', 'public');
        }

        $staff->update([
            'name' => $this->name,
            'nip' => $this->nip,
            'position' => $this->position,
            'phone' => $this->phone,
            'photo' => $photoPath,
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Data staff berhasil diperbarui.');
    }

    public function delete($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
                Storage::disk('public')->delete($staff->photo);
            }
            $staff->delete();
            session()->flash('message', 'Data staff dihapus.');
        }
    }

    public function render()
    {
        $staffs = Staff::where('name', 'like', '%'.$this->search.'%')
                    ->orderBy('name')
                    ->paginate(10);

        return view('livewire.admin.staff.index', ['staffs' => $staffs]);
    }
}