<div class="max-w-5xl mx-auto">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Absensi Diniyah</h2>
            <p class="text-sm text-gray-500">Pilih kelas untuk melakukan presensi.</p>
        </div>
        
        <div class="flex items-center gap-2 bg-white p-2 rounded-lg border border-gray-200 shadow-sm">
            <span class="text-sm text-gray-500 pl-2">Tanggal:</span>
            <input wire:model.live="date" type="date" class="border-none text-gray-800 focus:ring-0 text-sm font-bold">
        </div>
    </div>

    @if(!$activeYear)
        <div class="bg-red-100 text-red-700 p-4 rounded-lg text-center font-bold">
            Tahun Ajaran Aktif belum disetting! Silakan hubungi Admin.
        </div>
    @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($schedules as $sch)
            
                @php
                    $alreadyAbsen = \App\Models\Attendance::where('schedule_id', $sch->id)->where('date', $date)->exists();
                @endphp

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                    <div class="h-2 w-full {{ $alreadyAbsen ? 'bg-green-500' : 'bg-blue-500' }}"></div>
                    
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-xs font-bold px-2 py-1 rounded bg-gray-100 text-gray-600">
                                {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                            </span>
                            @if($alreadyAbsen)
                                <span class="text-xs font-bold text-green-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Sudah Absen
                                </span>
                            @else
                                <span class="text-xs font-bold text-gray-400">Belum Absen</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $sch->subject->name }}</h3>
                        <div class="text-sm text-gray-600 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Kelas {{ $sch->islamicClass->name }} {{ $sch->islamicClass->class }}{{ $sch->islamicClass->sub_class }}
                        </div>

                        <div class="border-t border-gray-100 pt-3 flex items-center gap-2">
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">
                                {{ substr($sch->staff->name, 0, 1) }}
                            </div>
                            <span class="text-xs text-gray-500 truncate">{{ $sch->staff->name }}</span>
                        </div>

                        @php
                                // 1. Definisikan Waktu (Timezone User/Jakarta)
                                $now = \Carbon\Carbon::now('Asia/Jakarta');
                        
                                $now = \Carbon\Carbon::now(); // Jam Server Sekarang
                                
                                // Gabungkan tanggal yang dipilih di filter dengan jam jadwal
                                $start = \Carbon\Carbon::parse($date . ' ' . $sch->start_time);
                                $end   = \Carbon\Carbon::parse($date . ' ' . $sch->end_time);

                                // 2. Atur Toleransi (15 Menit Sebelum & Sesudah)
                                $openGate  = $start->copy()->subMinutes(15);
                                $closeGate = $end->copy()->addMinutes(15);

                                // 3. Cek Status
                                $isToday = \Carbon\Carbon::parse($date)->isToday(); // Cek apakah filter tanggal = hari ini
                                $alreadyAbsen = \App\Models\Attendance::where('schedule_id', $sch->id)->where('date', $date)->exists();
                                
                                // 4. Logika Disable (Guru tidak bisa absen diluar jam, Admin bebas)
                                $isLocked = false;
                                $statusText = "";
                                
                                // Jika User BUKAN Super Admin, terapkan aturan waktu
                                if (!auth()->user()->hasRole('super_admin')) {
                                    if (!$isToday) {
                                        // Tidak bisa absen hari kemarin/besok
                                        $isLocked = true;
                                        $statusText = "Bukan Hari Ini";
                                    } elseif ($now->lt($openGate)) {
                                        // Belum waktunya (sebelum toleransi awal)
                                        $isLocked = true;
                                        $statusText = "Belum Mulai (" . $openGate->format('H:i') . ")";
                                    } elseif ($now->gt($closeGate)) {
                                        // Lewat waktu (setelah toleransi akhir)
                                        $isLocked = true;
                                        $statusText = "Waktu Habis";
                                    }
                                }
                            @endphp

                            <div class="mt-4">
                                @if($isLocked)
                                    <button disabled class="w-full py-2 rounded-lg font-bold text-sm bg-gray-200 text-gray-500 cursor-not-allowed border border-gray-300 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        {{ $statusText }}
                                    </button>
                                @else
                                    <a href="{{ route('admin.attendance.create', ['schedule_id' => $sch->id, 'date' => $date]) }}" 
                                    class="w-full text-center py-2 rounded-lg font-medium transition flex items-center justify-center gap-2
                                    {{ $alreadyAbsen 
                                        ? 'bg-green-50 text-green-700 hover:bg-green-100 border border-green-200' 
                                        : 'bg-blue-500 text-white hover:bg-blue-600 shadow-lg shadow-blue-500/30' }}">
                                        
                                        @if($alreadyAbsen)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Edit Absensi
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                            Mulai Absen
                                        @endif
                                    </a>
                                    
                                    @if(!$alreadyAbsen)
                                        <div class="text-xs text-center text-gray-400 mt-2">
                                            Buka: {{ $openGate->format('H:i') }} - {{ $closeGate->format('H:i') }}
                                        </div>
                                    @endif
                                @endif
                            </div>

                        {{-- <div class="mt-4">
                            <a href="{{ route('admin.attendance.create', ['schedule_id' => $sch->id, 'date' => $date]) }}"
                               class="block w-full text-center py-2 rounded-lg font-medium transition 
                               {{ $alreadyAbsen 
                                  ? 'bg-green-50 text-green-700 hover:bg-green-100 border border-green-200' 
                                  : 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-500/30' }}">
                                {{ $alreadyAbsen ? 'Edit Absensi' : 'Mulai Absen' }}
                            </a>
                        </div> --}}
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-lg border border-dashed border-gray-300">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-gray-500 font-medium">Tidak ada jadwal pelajaran untuk hari {{ $todayName }}.</p>
                    <p class="text-sm text-gray-400">Atau Anda belum membuat jadwal di menu Akademik.</p>
                </div>
            @endforelse
        </div>
    @endif
</div>