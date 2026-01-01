<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Rekap Kinerja Guru</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Laporan kehadiran mengajar berdasarkan data jurnal kelas.</p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto bg-white dark:bg-zinc-900 p-1.5 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
            <div class="relative w-full md:w-40">
                <select wire:model.live="month" class="block w-full rounded-lg border-0 py-2 pl-3 pr-8 text-zinc-900 dark:text-zinc-100 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-700 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-transparent">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->locale('id')->monthName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="h-6 w-px bg-zinc-200 dark:bg-zinc-700"></div>

            <div class="relative w-full md:w-28">
                <select wire:model.live="year" class="block w-full rounded-lg border-0 py-2 pl-3 pr-8 text-zinc-900 dark:text-zinc-100 ring-1 ring-inset ring-zinc-300 dark:ring-zinc-700 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-transparent">
                    @foreach(range(date('Y'), date('Y')-2) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-100 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Guru / Staff</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Jadwal</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Hadir</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Absen/Kosong</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider w-48">Performa</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-zinc-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800 bg-white dark:bg-zinc-900">
                    @forelse($teachers as $teacher)
                    @php 
                        $wajib = $teacher->stats['wajib'];
                        $hadir = $teacher->stats['hadir'];
                        $absen = $wajib - $hadir;
                        $persen = $teacher->stats['persen'];
                        
                        // Color logic
                        $colorClass = $persen >= 90 ? 'bg-emerald-500' : ($persen >= 70 ? 'bg-amber-500' : 'bg-rose-500');
                        $textClass = $persen >= 90 ? 'text-emerald-600 dark:text-emerald-400' : ($persen >= 70 ? 'text-amber-600 dark:text-amber-400' : 'text-rose-600 dark:text-rose-400');
                    @endphp
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 shrink-0 rounded-full bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm ring-1 ring-white dark:ring-zinc-800 shadow-sm">
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $teacher->name }}</div>
                                    <div class="text-xs text-zinc-500 font-mono">{{ $teacher->nip ?? 'NIP: -' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200">
                                {{ $wajib }} Jam
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">{{ $hadir }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($absen > 0)
                                <span class="text-sm font-bold text-rose-500">{{ $absen }}</span>
                            @else
                                <span class="text-zinc-300">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                            <div class="w-full">
                                <div class="flex justify-between items-end mb-1">
                                    <span class="text-xs font-bold {{ $textClass }}">{{ $persen }}%</span>
                                </div>
                                <div class="w-full bg-zinc-100 dark:bg-zinc-700 rounded-full h-2 overflow-hidden">
                                    <div class="{{ $colorClass }} h-2 rounded-full" style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="showDetail({{ $teacher->id }})" 
                                    class="text-zinc-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition flex items-center justify-end gap-1 ml-auto group-hover:translate-x-1 duration-200">
                                <span>Detail</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-zinc-50 dark:bg-zinc-800 p-4 rounded-full mb-3">
                                    <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <p class="text-zinc-500 font-medium">Belum ada data guru yang aktif untuk periode ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($showDetailModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-zinc-900/70 backdrop-blur-sm transition-opacity" wire:click="closeDetail"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block align-bottom bg-white dark:bg-zinc-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full border border-zinc-200 dark:border-zinc-800">
                
                <div class="bg-white dark:bg-zinc-900 px-6 py-5 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center sticky top-0 z-10">
                    <div>
                        <h3 class="text-lg leading-6 font-bold text-zinc-900 dark:text-white" id="modal-title">
                            Riwayat Mengajar
                        </h3>
                        <p class="text-sm text-zinc-500 mt-0.5">{{ $selectedStaff->name }} ({{ $month }}/{{ $year }})</p>
                    </div>
                    <button wire:click="closeDetail" class="rounded-lg p-2 text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="max-h-[60vh] overflow-y-auto">
                    <table class="min-w-full divide-y divide-zinc-100 dark:divide-zinc-800">
                        <thead class="bg-zinc-50 dark:bg-zinc-800 sticky top-0 z-10 shadow-sm">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Mata Pelajaran & Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Jam</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-100 dark:divide-zinc-800">
                            @forelse($detailReport as $row)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ \Carbon\Carbon::parse($row['date'])->format('d/m/Y') }}</div>
                                    <div class="text-xs text-zinc-500">{{ $row['day'] }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-zinc-800 dark:text-zinc-200 font-medium">{{ $row['subject'] }}</div>
                                    <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-800">
                                        {{ $row['class'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 font-mono">
                                    {{ $row['time'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    @if($row['is_present'])
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hadir
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 border border-rose-100 dark:border-rose-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Tidak Hadir
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-zinc-500 italic">
                                    Tidak ada jadwal mengajar pada bulan ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-zinc-50 dark:bg-zinc-800 px-6 py-4 sm:flex sm:flex-row-reverse border-t border-zinc-100 dark:border-zinc-800">
                    <button type="button" wire:click="closeDetail" class="w-full inline-flex justify-center rounded-xl border border-zinc-300 dark:border-zinc-600 shadow-sm px-4 py-2 bg-white dark:bg-zinc-900 text-base font-medium text-zinc-700 dark:text-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>