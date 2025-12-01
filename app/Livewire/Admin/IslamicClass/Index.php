<?php

namespace App\Livewire\Admin\IslamicClass;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IslamicClass;

class Index extends Component
{
    use WithPagination;

    public $name, $class, $sub_class;
    public $isEdit = false;
    public $editId;

    public function resetInput()
    {
        $this->name = '';
        $this->class = '';
        $this->sub_class = '';
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
            'class' => 'required',
            'sub_class' => 'required',
        ]);

        IslamicClass::create([
            'name' => $this->name,
            'class' => $this->class,
            'sub_class' => $this->sub_class,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = IslamicClass::findOrFail($id);
        $this->editId = $id;
        $this->name = $data->name;
        $this->class = $data->class;
        $this->sub_class = $data->sub_class;
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'class' => 'required',
            'sub_class' => 'required',
        ]);

        if($this->editId) {
            $data = IslamicClass::findOrFail($this->editId);
            $data->update([
                'name' => $this->name,
                'class' => $this->class,
                'sub_class' => $this->sub_class,
            ]);
            
            $this->dispatch('close-modal');
            $this->resetInput();
            session()->flash('message', 'Kelas berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        IslamicClass::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.islamic-class.index', [
            'classes' => IslamicClass::orderBy('class')->paginate(10)
        ]);
    }
}