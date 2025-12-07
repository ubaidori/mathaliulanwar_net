<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Jadwal Pelajaran</h2>
            <div class="text-sm text-gray-500 flex items-center gap-2">
                <span>Tahun Ajaran Aktif:</span>
                @if($activeYear)
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded font-bold">{{ $activeYear->name }} ({{ $activeYear->semester }})</span>
                @else
                    <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded font-bold">Belum diset!</span>
                @endif
            </div>
        </div>
        
        <div class="flex gap-3 w-full md:w-auto">
            <select wire:model.live="classFilter" class="border-gray-300 rounded-lg focus:ring-pesantren-500 w-full md:w-48">
                <option value="">-- Pilih Kelas --</option>
                @foreach($classes as $cls)
                    <option value="{{ $cls->id }}">{{ $cls->name }} {{ $cls->class }}{{ $cls->sub_class }}</option>
                @endforeach
            </select>

            <button wire:click="create" 
                {{ !$classFilter || !$activeYear ? 'disabled' : '' }}
                class="bg-pesantren-500 hover:bg-pesantren-600 disabled:bg-gray-300 text-white px-4 py-2 rounded-lg shadow-lg shrink-0">
                + Jadwal
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('message') }}</div>
    @endif
    
    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($classFilter && $activeYear)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad']; @endphp
            
            @foreach($days as $day)
                <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden flex flex-col h-full">
                    <div class="bg-pesantren-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 uppercase">{{ $day }}</h3>
                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded border">
                            {{ isset($schedulesGrouped[$day]) ? $schedulesGrouped[$day]->count() : 0 }} Mapel
                        </span>
                    </div>

                    <div class="p-0 flex-1">
                        @if(isset($schedulesGrouped[$day]))
                            <table class="w-full text-left">
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($schedulesGrouped[$day] as $sch)
                                    <tr class="group hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 align-top">
                                            <div class="text-sm font-bold text-gray-800">
                                                {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $sch->subject->code ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="text-sm font-medium text-pesantren-700">{{ $sch->subject->name }}</div>
                                            <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $sch->staff->name }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-3 text-right align-top">
                                            <div class="flex flex-col gap-1 opacity-0 group-hover:opacity-100 transition">
                                                <button wire:click="edit({{ $sch->id }})" class="text-blue-600 hover:text-blue-800 text-xs font-bold">Edit</button>
                                                <button wire:click="delete({{ $sch->id }})" wire:confirm="Hapus?" class="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-6 text-center text-gray-400 text-sm italic">
                                Tidak ada jadwal (Libur)
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 bg-white rounded-lg border border-dashed border-gray-300 text-gray-500">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p class="text-lg font-medium">Silakan Pilih Kelas Terlebih Dahulu</p>
            <p class="text-sm">Untuk melihat atau menambahkan jadwal pelajaran.</p>
        </div>
    @endif

    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-gray-800">
                {{ $isEdit ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}
            </h3>
            
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <label class="text-sm font-medium text-gray-700">Hari</label>
                        <select wire:model="day" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Ahad">Ahad</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label class="text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input wire:model="start_time" type="time" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                    </div>
                    <div class="col-span-1">
                        <label class="text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input wire:model="end_time" type="time" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Mata Pelajaran</label>
                    <select wire:model="subject_id" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($subjects as $subj)
                            <option value="{{ $subj->id }}">{{ $subj->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Guru Pengampu</label>
                    <select wire:model="staff_id" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500">Batal</button>
                    <button type="submit" class="bg-pesantren-500 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>