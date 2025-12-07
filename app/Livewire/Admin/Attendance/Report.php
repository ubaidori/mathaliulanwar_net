<?php

namespace App\Livewire\Admin\Attendance;

use Livewire\Component;
use App\Models\IslamicClass;
use App\Models\Subject;
use App\Models\Santri;
use App\Models\Schedule;
use App\Models\Attendance;
use Carbon\Carbon;

class Report extends Component
{
    // Filter Variables
    public $class_id;
    public $subject_id;
    public $start_date;
    public $end_date;

    public function mount()
    {
        // Default tanggal: 1 bulan terakhir
        $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        $santris = [];
        $dates = [];
        $attendances = [];

        // Hanya proses jika filter sudah dipilih lengkap
        if ($this->class_id && $this->subject_id) {
            
            // 1. Ambil Santri di kelas tersebut
            $santris = Santri::where('islamic_class_id', $this->class_id)
                        ->whereNull('drop_date') // Hanya santri aktif
                        ->orderBy('name')
                        ->get();

            // 2. Ambil Jadwal ID yang sesuai dengan Kelas & Mapel
            // Kita butuh ID jadwal untuk mencari absensi
            $scheduleIds = Schedule::where('islamic_class_id', $this->class_id)
                            ->where('subject_id', $this->subject_id)
                            ->pluck('id');

            // 3. Ambil Data Absensi sesuai Range Tanggal
            $rawAttendance = Attendance::whereIn('schedule_id', $scheduleIds)
                            ->whereBetween('date', [$this->start_date, $this->end_date])
                            ->get();

            // 4. Ambil daftar Tanggal unik (Kolom Header Tabel)
            $dates = $rawAttendance->pluck('date')
                        ->unique()
                        ->sort()
                        ->values(); // Reset keys

            // 5. Mapping Data agar mudah dipanggil di View: $attendances[santri_id][tanggal] = Status
            foreach ($rawAttendance as $att) {
                // Format tanggal harus sama persis stringnya
                $attendances[$att->santri_id][$att->date] = $att->status;
            }
        }

        return view('livewire.admin.attendance.report', [
            'classes' => IslamicClass::orderBy('class')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'report_santris' => $santris,
            'report_dates' => $dates,
            'report_data' => $attendances
        ]);
    }
}