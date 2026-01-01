<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Absensi Diniyah</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Silakan pilih jadwal kelas untuk melakukan presensi santri.</p>
        </div>
        
        <div class="w-full md:w-auto">
            <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Tanggal Presensi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <input wire:model.live="date" type="date" 
                       class="block w-full md:w-56 pl-10 pr-4 py-2 bg-white dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 rounded-lg text-sm font-bold text-zinc-800 dark:text-zinc-100 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer">
            </div>
        </div>
    </div>

    @if(!$activeYear)
        <div class="rounded-xl border border-red-200 bg-red-50 p-6 text-center dark:border-red-900/50 dark:bg-red-900/20">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="mt-2 text-sm font-semibold text-red-800 dark:text-red-200">Konfigurasi Diperlukan</h3>
            <p class="mt-1 text-sm text-red-700 dark:text-red-300">Tahun Ajaran Aktif belum disetting! Silakan hubungi Administrator.</p>
        </div>
    @else

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($schedules as $sch)
            
                @php
                    // LOGIC BLOCK (Preserved)
                    $now = \Carbon\Carbon::now(); 
                    
                    // Gabungkan tanggal filter dengan jam jadwal
                    $start = \Carbon\Carbon::parse($date . ' ' . $sch->start_time);
                    $end   = \Carbon\Carbon::parse($date . ' ' . $sch->end_time);

                    // Toleransi
                    $openGate  = $start->copy()->subMinutes(15);
                    $closeGate = $end->copy()->addMinutes(15);

                    // Status Check
                    $isToday = \Carbon\Carbon::parse($date)->isToday();
                    $alreadyAbsen = \App\Models\Attendance::where('schedule_id', $sch->id)->where('date', $date)->exists();
                    
                    // Locking Logic
                    $isLocked = false;
                    $statusText = "";
                    
                    if (!auth()->user()->hasRole('super_admin')) {
                        if (!$isToday) {
                            $isLocked = true;
                            $statusText = "Bukan Hari Ini";
                        } elseif ($now->lt($openGate)) {
                            $isLocked = true;
                            $statusText = "Belum Mulai";
                        } elseif ($now->gt($closeGate)) {
                            $isLocked = true;
                            $statusText = "Waktu Habis";
                        }
                    }
                @endphp

                <div class="group relative flex flex-col bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-lg hover:border-indigo-300 dark:hover:border-indigo-700 transition duration-300 overflow-hidden">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $alreadyAbsen ? 'bg-emerald-500' : ($isLocked ? 'bg-zinc-300 dark:bg-zinc-700' : 'bg-indigo-500') }}"></div>

                    <div class="p-5 flex flex-col h-full">
                        <div class="flex justify-between items-center mb-3 pl-2">
                            <span class="inline-flex items-center rounded-md bg-zinc-100 dark:bg-zinc-800 px-2 py-1 text-xs font-mono font-medium text-zinc-600 dark:text-zinc-300 ring-1 ring-inset ring-zinc-500/10">
                                {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                            </span>
                            
                            @if($alreadyAbsen)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/20">
                                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                    Sudah Absen
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-zinc-50 dark:bg-zinc-800 px-2 py-1 text-xs font-medium text-zinc-500 ring-1 ring-inset ring-zinc-500/10">
                                    Belum Absen
                                </span>
                            @endif
                        </div>

                        <div class="pl-2 mb-4 flex-1">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white leading-tight mb-1">{{ $sch->subject->name }}</h3>
                            <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Kls {{ $sch->islamicClass->name }} <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ $sch->islamicClass->class }}{{ $sch->islamicClass->sub_class }}</span></span>
                            </div>
                        </div>

                        <div class="pl-2 mb-5 flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center text-xs font-bold text-indigo-700 dark:text-indigo-300 ring-1 ring-white dark:ring-zinc-800 shadow-sm">
                                {{ substr($sch->staff->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300 truncate">{{ $sch->staff->name }}</span>
                        </div>

                        <div class="pl-2 mt-auto">
                            @if($isLocked)
                                <button disabled class="w-full py-2.5 rounded-lg text-sm font-semibold bg-zinc-100 dark:bg-zinc-800 text-zinc-400 dark:text-zinc-500 cursor-not-allowed border border-zinc-200 dark:border-zinc-700 flex items-center justify-center gap-2">
                                    @if($statusText == 'Waktu Habis')
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @elseif($statusText == 'Belum Mulai')
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    @endif
                                    {{ $statusText }}
                                </button>
                                @if($statusText == 'Belum Mulai')
                                    <p class="text-[10px] text-center text-zinc-400 mt-2">
                                        Dibuka pukul {{ $openGate->format('H:i') }}
                                    </p>
                                @endif
                            @else
                                <a href="{{ route('admin.attendance.create', ['schedule_id' => $sch->id, 'date' => $date]) }}" 
                                   class="w-full text-center py-2.5 rounded-lg text-sm font-bold transition flex items-center justify-center gap-2 shadow-sm
                                   {{ $alreadyAbsen 
                                        ? 'bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-50 dark:hover:bg-zinc-700' 
                                        : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-500/20' }}">
                                    
                                    @if($alreadyAbsen)
                                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Edit Absensi
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Mulai Absen
                                    @endif
                                </a>
                                
                                @if(!$alreadyAbsen)
                                    <div class="text-[10px] text-center font-mono text-zinc-400 mt-2 flex justify-center items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                        <span>Buka: {{ $openGate->format('H:i') }} - {{ $closeGate->format('H:i') }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white dark:bg-zinc-900 rounded-xl border-2 border-dashed border-zinc-200 dark:border-zinc-800">
                    <div class="bg-zinc-50 dark:bg-zinc-800 p-4 rounded-full mb-4">
                        <svg class="w-12 h-12 text-zinc-300 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Tidak Ada Jadwal</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1">Tidak ditemukan jadwal pelajaran untuk hari <span class="font-semibold">{{ $todayName ?? 'ini' }}</span>.</p>
                </div>
            @endforelse
        </div>
    @endif
</div>