<?php

namespace App\Livewire\Admin\Academic;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subject;

class SubjectIndex extends Component
{
    use WithPagination;

    public $name, $code, $description;
    public $isEdit = false;
    public $editId;
    public $search = '';

    public function resetInput()
    {
        $this->name = '';
        $this->code = '';
        $this->description = '';
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
        $this->validate(['name' => 'required']);

        Subject::create([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Mapel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Subject::findOrFail($id);
        $this->editId = $id;
        $this->name = $data->name;
        $this->code = $data->code;
        $this->description = $data->description;
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate(['name' => 'required']);

        if ($this->editId) {
            Subject::findOrFail($this->editId)->update([
                'name' => $this->name,
                'code' => $this->code,
                'description' => $this->description,
            ]);
            
            $this->dispatch('close-modal');
            $this->resetInput();
            session()->flash('message', 'Mapel berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        Subject::find($id)->delete();
    }

    public function render()
    {
        $subjects = Subject::where('name', 'like', '%'.$this->search.'%')
                    ->latest()
                    ->paginate(10);

        return view('livewire.admin.academic.subject-index', ['subjects' => $subjects]);
    }
}