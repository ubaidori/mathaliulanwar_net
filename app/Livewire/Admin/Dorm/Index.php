<?php

namespace App\Livewire\Admin\Dorm;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dorm;

class Index extends Component
{
    use WithPagination;

    // Properti Data
    public $block, $room_number, $capacity, $zone = 'putra';
    
    // Properti Mode (Edit/Create)
    public $isEdit = false;
    public $editId;

    // Reset Input saat modal ditutup/dibuka baru
    public function resetInput()
    {
        $this->block = '';
        $this->room_number = '';
        $this->capacity = '';
        $this->zone = 'putra';
        $this->isEdit = false;
        $this->editId = null;
    }

    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal'); // Memicu modal terbuka di frontend
    }

    public function store()
    {
        $this->validate([
            'block' => 'required',
            'room_number' => 'required|numeric',
            'capacity' => 'required|numeric',
            'zone' => 'required',
        ]);

        Dorm::create([
            'block' => $this->block,
            'room_number' => $this->room_number,
            'capacity' => $this->capacity,
            'zone' => $this->zone,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Asrama berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dorm = Dorm::findOrFail($id);
        
        $this->editId = $id;
        $this->block = $dorm->block;
        $this->room_number = $dorm->room_number;
        $this->capacity = $dorm->capacity;
        $this->zone = $dorm->zone;
        
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'block' => 'required',
            'room_number' => 'required|numeric',
            'capacity' => 'required|numeric',
            'zone' => 'required',
        ]);

        if ($this->editId) {
            $dorm = Dorm::findOrFail($this->editId);
            $dorm->update([
                'block' => $this->block,
                'room_number' => $this->room_number,
                'capacity' => $this->capacity,
                'zone' => $this->zone,
            ]);
            
            $this->dispatch('close-modal');
            $this->resetInput();
            session()->flash('message', 'Data asrama berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        Dorm::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.dorm.index', [
            'dorms' => Dorm::latest()->paginate(10)
        ]);
    }
}