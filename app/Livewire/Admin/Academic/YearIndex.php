<?php

namespace App\Livewire\Admin\Academic;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AcademicYear;

class YearIndex extends Component
{
    use WithPagination;

    public $name, $semester = 'Ganjil';
    public $isEdit = false;
    public $editId;

    public function resetInput()
    {
        $this->name = '';
        $this->semester = 'Ganjil';
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
            'semester' => 'required'
        ]);

        AcademicYear::create([
            'name' => $this->name,
            'semester' => $this->semester,
            'is_active' => false // Default tidak aktif
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = AcademicYear::findOrFail($id);
        $this->editId = $id;
        $this->name = $data->name;
        $this->semester = $data->semester;
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'semester' => 'required'
        ]);

        if ($this->editId) {
            $data = AcademicYear::findOrFail($this->editId);
            $data->update([
                'name' => $this->name,
                'semester' => $this->semester,
            ]);
            
            $this->dispatch('close-modal');
            $this->resetInput();
            session()->flash('message', 'Tahun ajaran berhasil diperbarui.');
        }
    }

    // LOGIC PENTING: Mengaktifkan Tahun Ajaran
    public function activate($id)
    {
        // Panggil fungsi statis yang sudah kita buat di Model langkah sebelumnya
        AcademicYear::setActive($id);
        session()->flash('message', 'Tahun ajaran aktif berhasil diubah.');
    }

    public function delete($id)
    {
        $year = AcademicYear::find($id);
        if($year->is_active) {
            session()->flash('error', 'Tidak bisa menghapus tahun ajaran yang sedang aktif!');
            return;
        }
        $year->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.academic.year-index', [
            'years' => AcademicYear::latest()->paginate(10)
        ]);
    }
}