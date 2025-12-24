<?php

namespace App\Livewire\Admin\Attendance;

use Livewire\Component;
use App\Models\Staff;
use App\Models\Schedule;
use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TeacherReport extends Component
{
    public $month;
    public $year;
    
    // Variabel untuk Modal Detail
    public $showDetailModal = false;
    public $selectedStaff = null;
    public $detailReport = [];

    public function mount()
    {
        // Default set ke bulan & tahun sekarang
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function showDetail($staffId)
    {
        $this->selectedStaff = Staff::find($staffId);
        // Ambil detail kehadiran (flag true)
        $this->detailReport = $this->calculateAttendance($staffId, true); 
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailReport = [];
    }

    /**
     * Logika Utama: Membandingkan Jadwal (Rencana) vs Absensi (Realisasi)
     */
    private function calculateAttendance($staffId, $returnDetail = false)
    {
        // 1. Ambil Jadwal Guru Tersebut
        $schedules = Schedule::where('staff_id', $staffId)->get();
        
        // 2. Tentukan Rentang Tanggal (Tgl 1 s/d Akhir Bulan)
        $startDate = Carbon::createFromDate($this->year, $this->month, 1);
        $endDate   = $startDate->copy()->endOfMonth();
        
        // Agar perhitungan "Bolos" tidak menghitung hari esok (masa depan)
        if ($endDate->isFuture()) {
            $endDate = Carbon::now(); 
        }

        // Jika bulan yang dipilih adalah bulan depan (belum terjadi), hentikan
        if ($startDate->isFuture()) {
            return $returnDetail ? [] : ['wajib' => 0, 'hadir' => 0, 'persen' => 0];
        }

        $period = CarbonPeriod::create($startDate, $endDate);

        $totalWajib = 0;
        $totalHadir = 0;
        $details = [];

        // 3. Loop setiap hari dalam rentang tanggal
        foreach ($period as $date) {
            // Ubah format hari ke bahasa Indonesia (Senin, Selasa, dst)
            // Pastikan Locale Laravel Anda 'id', atau paksa di sini
            $dayName = $date->locale('id')->isoFormat('dddd'); 

            // Cek apakah hari ini guru punya jadwal?
            foreach ($schedules as $sch) {
                // Bandingkan hari (Case insensitive)
                if (strtolower($sch->day) == strtolower($dayName)) {
                    $totalWajib++;

                    // Cek di tabel Attendance
                    $isPresent = Attendance::where('schedule_id', $sch->id)
                                ->where('date', $date->format('Y-m-d'))
                                ->exists();

                    if ($isPresent) {
                        $totalHadir++;
                    }

                    // Simpan data untuk Modal Detail
                    if ($returnDetail) {
                        $details[] = [
                            'date' => $date->format('d M Y'),
                            'day' => $dayName,
                            'subject' => $sch->subject->name ?? '-',
                            'class' => $sch->islamicClass->name ?? '-', // Sesuaikan relasi class Anda
                            'time' => \Carbon\Carbon::parse($sch->start_time)->format('H:i'),
                            'status' => $isPresent ? 'Hadir' : 'Tidak Hadir', // Bisa diganti Alpha
                            'is_present' => $isPresent
                        ];
                    }
                }
            }
        }

        if ($returnDetail) {
            // Urutkan dari tanggal terbaru
            return array_reverse($details);
        }

        return [
            'wajib' => $totalWajib,
            'hadir' => $totalHadir,
            'persen' => $totalWajib > 0 ? round(($totalHadir / $totalWajib) * 100) : 0
        ];
    }

    public function render()
    {
        // Ambil Staff yang memiliki User (artinya dia Guru/Pegawai aktif)
        // Atau sesuaikan query ini jika Anda ingin semua staff tampil
        $teachers = Staff::whereNotNull('user_id')
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->get();

        // Inject perhitungan ke dalam object collection
        foreach ($teachers as $t) {
            $t->stats = $this->calculateAttendance($t->id);
        }

        return view('livewire.admin.attendance.teacher-report', [
            'teachers' => $teachers
        ]);
    }
}