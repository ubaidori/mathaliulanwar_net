<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Laporan Rekapitulasi</h2>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Monitoring kehadiran santri berdasarkan kelas dan mata pelajaran.</p>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-5 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <div>
                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Kelas</label>
                <select wire:model.live="class_id" class="input-flux">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}">{{ $c->name }} - {{ $c->class }}{{ $c->sub_class }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Mata Pelajaran</label>
                <select wire:model.live="subject_id" class="input-flux">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($subjects as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Dari Tanggal</label>
                <input wire:model.live="start_date" type="date" class="input-flux">
            </div>

            <div>
                <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-1.5">Sampai Tanggal</label>
                <input wire:model.live="end_date" type="date" class="input-flux">
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden relative min-h-[300px]">
        
        @if(!$class_id || !$subject_id)
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-full mb-4 animate-pulse">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Filter Data Belum Lengkap</h3>
                <p class="text-zinc-500 dark:text-zinc-400 max-w-sm mt-1">Silakan pilih <strong>Kelas</strong> dan <strong>Mata Pelajaran</strong> terlebih dahulu untuk memuat laporan.</p>
            </div>
        @else
            @if(count($report_dates) == 0)
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                    <svg class="w-12 h-12 text-zinc-300 dark:text-zinc-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="font-bold text-zinc-700 dark:text-zinc-300">Tidak ada data absensi ditemukan.</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Coba ubah rentang tanggal atau pastikan jadwal sudah diisi.</p>
                </div>
            @else
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700">
                            <tr>
                                <th class="px-4 py-3 sticky left-0 z-20 bg-zinc-50 dark:bg-zinc-800 text-xs font-bold text-zinc-500 uppercase tracking-wider w-12 text-center shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                    No
                                </th>
                                <th class="px-4 py-3 sticky left-12 z-20 bg-zinc-50 dark:bg-zinc-800 text-xs font-bold text-zinc-500 uppercase tracking-wider w-64 border-r border-zinc-200 dark:border-zinc-700 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                    Nama Santri
                                </th>
                                
                                @foreach($report_dates as $date)
                                    <th class="px-2 py-3 text-center border-r border-zinc-200/60 dark:border-zinc-700/60 min-w-[3.5rem]">
                                        <div class="text-sm font-bold text-zinc-700 dark:text-zinc-200">{{ \Carbon\Carbon::parse($date)->format('d') }}</div>
                                        <div class="text-[10px] font-medium text-zinc-400 uppercase">{{ \Carbon\Carbon::parse($date)->format('M') }}</div>
                                    </th>
                                @endforeach

                                <th class="px-2 py-3 text-center bg-emerald-50 dark:bg-emerald-900/20 text-emerald-800 dark:text-emerald-400 text-xs font-bold border-l border-emerald-100 dark:border-emerald-800 w-12" title="Hadir">H</th>
                                <th class="px-2 py-3 text-center bg-blue-50 dark:bg-blue-900/20 text-blue-800 dark:text-blue-400 text-xs font-bold w-12" title="Izin">I</th>
                                <th class="px-2 py-3 text-center bg-amber-50 dark:bg-amber-900/20 text-amber-800 dark:text-amber-400 text-xs font-bold w-12" title="Sakit">S</th>
                                <th class="px-2 py-3 text-center bg-rose-50 dark:bg-rose-900/20 text-rose-800 dark:text-rose-400 text-xs font-bold w-12" title="Alpha">A</th>
                                <th class="px-2 py-3 text-center bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs font-bold border-l border-zinc-200 dark:border-zinc-700 w-16">%</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800 text-sm">
                            @foreach($report_santris as $index => $santri)
                                @php
                                    $h = 0; $i = 0; $s = 0; $a = 0;
                                @endphp
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition duration-150 group">
                                    
                                    <td class="px-4 py-3 sticky left-0 z-10 bg-white dark:bg-zinc-900 group-hover:bg-zinc-50 dark:group-hover:bg-zinc-800 text-center text-zinc-400 text-xs font-mono shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 sticky left-12 z-10 bg-white dark:bg-zinc-900 group-hover:bg-zinc-50 dark:group-hover:bg-zinc-800 font-medium text-zinc-800 dark:text-zinc-200 border-r border-zinc-200 dark:border-zinc-700 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                                        {{ $santri->name }}
                                    </td>
                                    
                                    @foreach($report_dates as $date)
                                        @php
                                            $status = $report_data[$santri->id][$date] ?? '-';
                                            if($status == 'Hadir') $h++;
                                            elseif($status == 'Ijin') $i++;
                                            elseif($status == 'Sakit') $s++;
                                            elseif($status == 'Alpha') $a++;
                                        @endphp
                                        <td class="px-2 py-2 text-center border-r border-zinc-100 dark:border-zinc-800/50">
                                            @if($status == 'Hadir') 
                                                <div class="mx-auto w-2 h-2 rounded-full bg-emerald-500" title="Hadir"></div>
                                            @elseif($status == 'Ijin') 
                                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">I</span>
                                            @elseif($status == 'Sakit') 
                                                <span class="text-xs font-bold text-amber-500 dark:text-amber-400">S</span>
                                            @elseif($status == 'Alpha') 
                                                <span class="text-xs font-bold text-rose-500 dark:text-rose-400">A</span>
                                            @else 
                                                <span class="text-zinc-200 dark:text-zinc-700">-</span>
                                            @endif
                                        </td>
                                    @endforeach

                                    <td class="px-2 py-3 text-center text-xs font-bold bg-emerald-50/50 dark:bg-emerald-900/10 text-emerald-700 dark:text-emerald-400 border-l border-emerald-100 dark:border-emerald-900/30">
                                        {{ $h > 0 ? $h : '-' }}
                                    </td>
                                    <td class="px-2 py-3 text-center text-xs font-bold bg-blue-50/50 dark:bg-blue-900/10 text-blue-700 dark:text-blue-400">
                                        {{ $i > 0 ? $i : '-' }}
                                    </td>
                                    <td class="px-2 py-3 text-center text-xs font-bold bg-amber-50/50 dark:bg-amber-900/10 text-amber-700 dark:text-amber-400">
                                        {{ $s > 0 ? $s : '-' }}
                                    </td>
                                    <td class="px-2 py-3 text-center text-xs font-bold bg-rose-50/50 dark:bg-rose-900/10 text-rose-700 dark:text-rose-400">
                                        {{ $a > 0 ? $a : '-' }}
                                    </td>
                                    
                                    @php
                                        $totalPertemuan = count($report_dates);
                                        $persen = $totalPertemuan > 0 ? round(($h / $totalPertemuan) * 100) : 0;
                                        $colorClass = $persen < 70 ? 'text-rose-600 dark:text-rose-400' : 'text-emerald-600 dark:text-emerald-400';
                                    @endphp
                                    <td class="px-2 py-3 text-center font-bold text-xs bg-zinc-50 dark:bg-zinc-800 border-l border-zinc-200 dark:border-zinc-700 {{ $colorClass }}">
                                        {{ $persen }}%
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
    
    @if($class_id && $subject_id && count($report_dates) > 0)
        <div class="mt-4 flex flex-wrap gap-4 text-xs text-zinc-500 dark:text-zinc-400 justify-end">
            <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-emerald-500"></div> Hadir</div>
            <div class="flex items-center gap-1.5"><span class="font-bold text-blue-600">I</span> Izin</div>
            <div class="flex items-center gap-1.5"><span class="font-bold text-amber-500">S</span> Sakit</div>
            <div class="flex items-center gap-1.5"><span class="font-bold text-rose-500">A</span> Alpha</div>
        </div>
    @endif

    <style>
        .input-flux {
            @apply block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 transition duration-150;
        }
        /* Custom scrollbar for better look in table */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
        /* Dark mode scrollbar */
        @media (prefers-color-scheme: dark) {
            .custom-scrollbar::-webkit-scrollbar-track { background: #27272a; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #52525b; }
        }
    </style>
</div>