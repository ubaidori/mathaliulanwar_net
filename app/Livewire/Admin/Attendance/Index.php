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

        $user = auth()->user();
        $schedules = [];

        if ($this->activeYear) {
            $query = Schedule::where('academic_year_id', $this->activeYear->id)
                        ->where('day', $todayName);

            // LOGIC FILTER ROLE
            // Jika dia Guru, filter jadwal berdasarkan ID Staff dia
            if ($user->hasRole('guru')) {
                // Cek apakah user ini terhubung ke data staff?
                if ($user->staff) {
                    $query->where('staff_id', $user->staff->id);
                } else {
                    // User punya role guru tapi belum di-link ke data staff
                    // Kosongkan jadwal atau beri notifikasi
                    $schedules = []; 
                    return view('livewire.admin.attendance.index', [
                        'schedules' => $schedules, 
                        'todayName' => $todayName,
                        'error' => 'Akun Anda belum terhubung dengan Data Guru. Hubungi Admin.'
                    ]);
                }
            }
            // Jika Super Admin / Akademik, biarkan melihat semua (tidak ada where staff_id)

            $schedules = $query->orderBy('start_time')->get();
        }

        return view('livewire.admin.attendance.index', [
            'schedules' => $schedules,
            'todayName' => $todayName
        ]);
    }
}