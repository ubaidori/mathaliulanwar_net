<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                <a href="{{ route('admin.attendance.index') }}" class="hover:text-indigo-600 transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
                <span class="text-zinc-300">/</span>
                <span class="font-medium text-zinc-700 dark:text-zinc-300">Input Presensi</span>
            </div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">{{ $schedule->subject->name }}</h1>
            <div class="flex items-center gap-3 mt-2 text-sm">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-medium border border-zinc-200 dark:border-zinc-700">
                    <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Kelas {{ $schedule->islamicClass->name }} {{ $schedule->islamicClass->class }}{{ $schedule->islamicClass->sub_class }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 font-medium border border-indigo-100 dark:border-indigo-800">
                    <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $schedule->staff->name }}
                </span>
                <span class="text-zinc-400">|</span>
                <span class="font-mono font-bold text-zinc-600 dark:text-zinc-400">
                    {{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>

        <div class="flex gap-2 text-[10px] uppercase font-bold tracking-wider">
            <div class="flex flex-col items-center gap-1">
                <span class="w-8 h-8 flex items-center justify-center rounded bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-400 ring-1 ring-inset ring-emerald-600/20">H</span>
                <span class="text-zinc-400">Hadir</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <span class="w-8 h-8 flex items-center justify-center rounded bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-400 ring-1 ring-inset ring-blue-600/20">I</span>
                <span class="text-zinc-400">Izin</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <span class="w-8 h-8 flex items-center justify-center rounded bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-400 ring-1 ring-inset ring-amber-600/20">S</span>
                <span class="text-zinc-400">Sakit</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <span class="w-8 h-8 flex items-center justify-center rounded bg-rose-100 text-rose-700 dark:bg-rose-900/50 dark:text-rose-400 ring-1 ring-inset ring-rose-600/20">A</span>
                <span class="text-zinc-400">Alpha</span>
            </div>
        </div>
    </div>

    <form wire:submit="save">
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-16 text-center">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Santri</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center w-64">Status Kehadiran</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-1/4">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @foreach($santris as $index => $santri)
                        <tr class="group hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition duration-150">
                            <td class="px-6 py-4 text-center text-sm text-zinc-400 font-mono">
                                {{ $index + 1 }}
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $santri->name }}</span>
                                    <span class="text-xs text-zinc-400 font-mono mt-0.5">{{ $santri->nis }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    
                                    <label class="cursor-pointer relative">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Hadir" class="peer sr-only">
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-bold border border-zinc-200 dark:border-zinc-700 text-zinc-400 bg-white dark:bg-zinc-800 hover:bg-zinc-50 transition-all 
                                            peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-600 peer-checked:shadow-md peer-checked:scale-110 peer-checked:z-10
                                            peer-focus:ring-2 peer-focus:ring-emerald-500 peer-focus:ring-offset-1">
                                            H
                                        </div>
                                    </label>
                                    
                                    <label class="cursor-pointer relative">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Ijin" class="peer sr-only">
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-bold border border-zinc-200 dark:border-zinc-700 text-zinc-400 bg-white dark:bg-zinc-800 hover:bg-zinc-50 transition-all 
                                            peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-600 peer-checked:shadow-md peer-checked:scale-110 peer-checked:z-10
                                            peer-focus:ring-2 peer-focus:ring-blue-500 peer-focus:ring-offset-1">
                                            I
                                        </div>
                                    </label>

                                    <label class="cursor-pointer relative">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Sakit" class="peer sr-only">
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-bold border border-zinc-200 dark:border-zinc-700 text-zinc-400 bg-white dark:bg-zinc-800 hover:bg-zinc-50 transition-all 
                                            peer-checked:bg-amber-400 peer-checked:text-white peer-checked:border-amber-500 peer-checked:shadow-md peer-checked:scale-110 peer-checked:z-10
                                            peer-focus:ring-2 peer-focus:ring-amber-400 peer-focus:ring-offset-1">
                                            S
                                        </div>
                                    </label>

                                    <label class="cursor-pointer relative">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Alpha" class="peer sr-only">
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-bold border border-zinc-200 dark:border-zinc-700 text-zinc-400 bg-white dark:bg-zinc-800 hover:bg-zinc-50 transition-all 
                                            peer-checked:bg-rose-500 peer-checked:text-white peer-checked:border-rose-600 peer-checked:shadow-md peer-checked:scale-110 peer-checked:z-10
                                            peer-focus:ring-2 peer-focus:ring-rose-500 peer-focus:ring-offset-1">
                                            A
                                        </div>
                                    </label>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="relative">
                                    <input type="text" wire:model="notes.{{ $santri->id }}" placeholder="Tambahkan catatan..." 
                                           class="w-full text-sm bg-zinc-50 dark:bg-zinc-950 border-zinc-200 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 py-2 pl-3 transition-shadow placeholder-zinc-400">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" 
                    class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 focus:ring-4 focus:ring-indigo-500/30">
                <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                <svg wire:loading class="animate-spin w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                
                <span wire:loading.remove>Simpan Data Absensi</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>