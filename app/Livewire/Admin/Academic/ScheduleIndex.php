<?php

namespace App\Livewire\Admin\Academic;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\AcademicYear;
use App\Models\IslamicClass;
use App\Models\Subject;
use App\Models\Staff;

class ScheduleIndex extends Component
{
    // Filter
    public $classFilter = ''; // ID Kelas yang sedang dipilih
    
    // Form Input
    public $day, $start_time, $end_time, $subject_id, $staff_id;
    
    // State
    public $activeYear;
    public $isEdit = false;
    public $editId;

    public function mount()
    {
        // 1. Ambil Tahun Ajaran yang statusnya AKTIF
        $this->activeYear = AcademicYear::where('is_active', true)->first();
        
        // Default: Pilih kelas pertama jika belum ada filter
        if (!$this->classFilter) {
            $firstClass = IslamicClass::orderBy('class')->first();
            $this->classFilter = $firstClass ? $firstClass->id : null;
        }
    }

    public function resetInput()
    {
        $this->day = 'Senin';
        $this->start_time = '';
        $this->end_time = '';
        $this->subject_id = '';
        $this->staff_id = '';
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
            'classFilter' => 'required', // Kelas harus dipilih dulu
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time', // Jam selesai harus setelah jam mulai
            'subject_id' => 'required',
            'staff_id' => 'required',
        ]);

        if (!$this->activeYear) {
            session()->flash('error', 'Belum ada Tahun Ajaran Aktif! Silakan aktifkan dulu di menu Akademik.');
            return;
        }

        Schedule::create([
            'academic_year_id' => $this->activeYear->id,
            'islamic_class_id' => $this->classFilter,
            'subject_id' => $this->subject_id,
            'staff_id' => $this->staff_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $this->dispatch('close-modal');
        $this->resetInput();
        session()->flash('message', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Schedule::findOrFail($id);
        $this->editId = $id;
        $this->day = $data->day;
        $this->start_time = $data->start_time;
        $this->end_time = $data->end_time;
        $this->subject_id = $data->subject_id;
        $this->staff_id = $data->staff_id;
        
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'subject_id' => 'required',
            'staff_id' => 'required',
        ]);

        if ($this->editId) {
            Schedule::findOrFail($this->editId)->update([
                'day' => $this->day,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'subject_id' => $this->subject_id,
                'staff_id' => $this->staff_id,
            ]);
            
            $this->dispatch('close-modal');
            $this->resetInput();
            session()->flash('message', 'Jadwal berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        Schedule::find($id)->delete();
    }

    public function render()
    {
        // Ambil jadwal sesuai kelas yang dipilih & tahun aktif
        $schedules = [];
        if ($this->activeYear && $this->classFilter) {
            // Kita urutkan manual agar Senin muncul duluan (SQL Order by string akan berantakan: Jumat dulu baru Kamis)
            // Solusi simpel: Order by ID dulu atau gunakan FIELD sql. Disini kita ambil semua lalu group by day di view.
            $schedules = Schedule::where('academic_year_id', $this->activeYear->id)
                        ->where('islamic_class_id', $this->classFilter)
                        ->orderBy('start_time') // Urutkan jam
                        ->get()
                        ->groupBy('day'); // Kelompokkan per Hari
        }

        return view('livewire.admin.academic.schedule-index', [
            'schedulesGrouped' => $schedules,
            'classes' => IslamicClass::orderBy('class')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'staffs' => Staff::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}