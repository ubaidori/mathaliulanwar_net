<?php

namespace App\Livewire\Admin\Attendance;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\AcademicYear;
use Carbon\Carbon;

class Index extends Component
{
    public $date; // Tanggal yang dipilih (Default: Hari ini)
    public $activeYear;

    public function mount()
    {
        // Set default tanggal hari ini
        $this->date = Carbon::now()->format('Y-m-d');
        $this->activeYear = AcademicYear::where('is_active', true)->first();
    }

    public function render()
    {
        // 1. Cari Nama Hari dalam Bahasa Indonesia berdasarkan tanggal
        // Carbon::parse($this->date)->locale('id')->dayName kadang butuh config server
        // Kita pakai cara manual yang pasti akurat:
        $dayEnglish = Carbon::parse($this->date)->format('l');
        $daysMap = [
            'Sunday' => 'Ahad', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];
        $todayName = $daysMap[$dayEnglish];

        // 2. Ambil Jadwal Sesuai Hari & Tahun Aktif
        $schedules = [];
        if ($this->activeYear) {
            $schedules = Schedule::where('academic_year_id', $this->activeYear->id)
                        ->where('day', $todayName)
                        ->orderBy('start_time')
                        ->get();
        }

        return view('livewire.admin.attendance.index', [
            'schedules' => $schedules,
            'todayName' => $todayName
        ]);
    }
}