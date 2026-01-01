<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6" 
     x-data="{ showModal: false }"
     x-on:open-modal.window="showModal = true"
     x-on:close-modal.window="showModal = false">
    
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Jadwal Pelajaran</h1>
                @if($activeYear)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                        {{ $activeYear->name }} - {{ $activeYear->semester }}
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                        Tahun Ajaran Belum Diset
                    </span>
                @endif
            </div>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Pilih kelas terlebih dahulu untuk mengelola jadwal mingguan.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto items-end">
            <div class="w-full sm:w-64">
                <label class="block text-xs font-semibold text-zinc-500 dark:text-zinc-400 mb-1.5 uppercase tracking-wider">
                    Pilih Kelas
                </label>
                <select wire:model.live="classFilter" class="input-flux cursor-pointer">
                    <!-- <option value="">-- Pilih Kelas --</option> -->
                    @foreach($classes as $cls)
                        <option value="{{ $cls->id }}">{{ $cls->name }} - Kelas {{ $cls->class }}{{ $cls->sub_class }}</option>
                    @endforeach
                </select>
            </div>

            <button wire:click="create" 
                    {{ !$classFilter || !$activeYear ? 'disabled' : '' }}
                    class="h-[42px] inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-zinc-200 disabled:text-zinc-400 disabled:cursor-not-allowed dark:disabled:bg-zinc-800 dark:disabled:text-zinc-600 text-white text-sm font-medium rounded-lg transition shadow-sm gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Buat Jadwal
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('message') }}</span>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</span>
        </div>
    @endif

    @if($classFilter && $activeYear)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad']; @endphp
            
            @foreach($days as $day)
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 flex flex-col h-full overflow-hidden hover:border-indigo-300 dark:hover:border-indigo-700 transition duration-300">
                    <div class="px-5 py-3 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30 flex justify-between items-center">
                        <h3 class="font-bold text-zinc-800 dark:text-zinc-200 uppercase tracking-wide text-sm">{{ $day }}</h3>
                        @if(isset($schedulesGrouped[$day]) && $schedulesGrouped[$day]->count() > 0)
                            <span class="inline-flex items-center justify-center h-5 min-w-[20px] px-1.5 text-xs font-medium rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300">
                                {{ $schedulesGrouped[$day]->count() }} Mapel
                            </span>
                        @endif
                    </div>

                    <div class="flex-1 p-2">
                        @if(isset($schedulesGrouped[$day]))
                            <ul class="space-y-1">
                                @foreach($schedulesGrouped[$day] as $sch)
                                <li class="group relative flex items-start gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800 transition duration-150 border border-transparent hover:border-zinc-200 dark:hover:border-zinc-700">
                                    <div class="flex flex-col items-center justify-start pt-0.5 min-w-[3rem]">
                                        <span class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }}
                                        </span>
                                        <div class="w-px h-2 bg-zinc-200 dark:bg-zinc-700 my-0.5"></div>
                                        <span class="text-xs font-mono font-medium text-zinc-400">
                                            {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                                        </span>
                                    </div>

                                    <div class="flex-1 min-w-0 border-l border-zinc-100 dark:border-zinc-700 pl-3">
                                        <p class="text-sm font-bold text-zinc-900 dark:text-zinc-100 truncate">
                                            {{ $sch->subject->name }}
                                        </p>
                                        <div class="flex items-center gap-1.5 mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                            <svg class="w-3.5 h-3.5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            <span class="truncate">{{ $sch->staff->name }}</span>
                                        </div>
                                    </div>

                                    <div class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1 bg-white dark:bg-zinc-800 shadow-sm rounded-md border border-zinc-200 dark:border-zinc-700 p-0.5">
                                        <button wire:click="edit({{ $sch->id }})" class="p-1.5 text-zinc-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/50 rounded transition">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </button>
                                        <button wire:click="delete({{ $sch->id }})" wire:confirm="Hapus jadwal ini?" class="p-1.5 text-zinc-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/50 rounded transition">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="h-full min-h-[100px] flex flex-col items-center justify-center py-4 text-zinc-300 dark:text-zinc-700">
                                <span class="text-xs font-medium italic">Libur / Kosong</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-24 bg-white dark:bg-zinc-900 rounded-xl border-2 border-dashed border-zinc-200 dark:border-zinc-800">
            <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-full mb-4 animate-pulse">
                <svg class="w-10 h-10 text-indigo-400 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Silakan Pilih Kelas</h3>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-2 max-w-sm text-center">
                Pilih kelas melalui dropdown di atas untuk menampilkan, membuat, atau mengedit jadwal pelajaran.
            </p>
        </div>
    @endif

    <div x-show="showModal" 
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-zinc-900/60 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg transform overflow-hidden rounded-xl bg-white dark:bg-zinc-900 p-6 text-left shadow-2xl transition-all border border-zinc-200 dark:border-zinc-800"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-6">
                    {{ $isEdit ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}
                </h3>
                
                <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-5">
                    
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-4">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Hari</label>
                            <select wire:model="day" class="input-flux">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Ahad">Ahad</option>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Mulai</label>
                            <input wire:model="start_time" type="time" class="input-flux">
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Selesai</label>
                            <input wire:model="end_time" type="time" class="input-flux">
                            @error('end_time') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Mata Pelajaran</label>
                        <select wire:model="subject_id" class="input-flux">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($subjects as $subj)
                                <option value="{{ $subj->id }}">{{ $subj->name }} ({{ $subj->code ?? '-' }})</option>
                            @endforeach
                        </select>
                        @error('subject_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Guru Pengampu</label>
                        <select wire:model="staff_id" class="input-flux">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('staff_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3 mt-8">
                        <button type="button" @click="showModal = false" class="px-4 py-2 text-zinc-600 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 text-sm font-medium transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-bold shadow-md transition flex items-center gap-2">
                            <span wire:loading.remove>{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .input-flux {
            @apply block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 transition duration-150;
        }
    </style>
</div>