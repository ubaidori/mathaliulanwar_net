<?php

namespace App\Livewire\Admin\Attendance;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\Santri;
use App\Models\Attendance;

class Create extends Component
{
    public $schedule;
    public $date;
    public $santris;
    
    // Array untuk menampung inputan [santri_id => status]
    public $attendanceData = []; 
    // Array untuk catatan [santri_id => note]
    public $notes = [];

    public function mount($schedule_id, $date)
    {
        $this->schedule = Schedule::findOrFail($schedule_id);
        $this->date = $date;

        // 1. Ambil Santri yang ada di kelas ini
        $this->santris = Santri::where('islamic_class_id', $this->schedule->islamic_class_id)
                        ->whereNull('drop_date') // Hanya santri aktif
                        ->orderBy('name')
                        ->get();

        // 2. Cek apakah sudah pernah absen? Jika ya, load datanya (Mode Edit)
        $existing = Attendance::where('schedule_id', $schedule_id)
                    ->where('date', $date)
                    ->get()
                    ->keyBy('santri_id');

        foreach ($this->santris as $santri) {
            if (isset($existing[$santri->id])) {
                // Load data lama
                $this->attendanceData[$santri->id] = $existing[$santri->id]->status;
                $this->notes[$santri->id] = $existing[$santri->id]->note;
            } else {
                // Default Hadir
                $this->attendanceData[$santri->id] = 'Hadir';
                $this->notes[$santri->id] = '';
            }
        }
    }

    public function save()
    {
        foreach ($this->attendanceData as $santriId => $status) {
            Attendance::updateOrCreate(
                [
                    'schedule_id' => $this->schedule->id,
                    'santri_id' => $santriId,
                    'date' => $this->date,
                ],
                [
                    'status' => $status,
                    'note' => $this->notes[$santriId] ?? null,
                    'user_id' => auth()->user->check() ? auth()->user->id() : null,
                ]
            );
        }

        session()->flash('message', 'Absensi berhasil disimpan!');
        return redirect()->route('admin.attendance.index');
    }

    public function render()
    {
        return view('livewire.admin.attendance.create');
    }
}
