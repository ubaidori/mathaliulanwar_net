<div class="max-w-4xl mx-auto">
    
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                <a href="{{ route('admin.attendance.index') }}" class="hover:underline">&larr; Kembali</a>
                <span>/</span>
                <span>{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $schedule->subject->name }}</h2>
            <p class="text-gray-600">Kelas {{ $schedule->islamicClass->name }} - {{ $schedule->staff->name }}</p>
        </div>
        
        <div class="flex gap-2 text-xs font-bold">
            <div class="px-3 py-1 bg-green-100 text-green-700 rounded-lg">H: Hadir</div>
            <div class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">I: Ijin</div>
            <div class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg">S: Sakit</div>
            <div class="px-3 py-1 bg-red-100 text-red-700 rounded-lg">A: Alpha</div>
        </div>
    </div>

    <form wire:submit="save">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold border-b">
                        <tr>
                            <th class="px-4 py-3 w-10">No</th>
                            <th class="px-4 py-3">Nama Santri</th>
                            <th class="px-4 py-3 text-center">Kehadiran</th>
                            <th class="px-4 py-3 w-48">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($santris as $index => $santri)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $santri->name }}
                                <div class="text-xs text-gray-400 font-normal">{{ $santri->nis }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-1">
                                    <label class="cursor-pointer">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Hadir" class="peer sr-only">
                                        <div class="w-8 h-8 rounded flex items-center justify-center font-bold text-sm border border-gray-200 text-gray-400 peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-600 transition">H</div>
                                    </label>
                                    
                                    <label class="cursor-pointer">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Ijin" class="peer sr-only">
                                        <div class="w-8 h-8 rounded flex items-center justify-center font-bold text-sm border border-gray-200 text-gray-400 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-600 transition">I</div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Sakit" class="peer sr-only">
                                        <div class="w-8 h-8 rounded flex items-center justify-center font-bold text-sm border border-gray-200 text-gray-400 peer-checked:bg-yellow-400 peer-checked:text-white peer-checked:border-yellow-500 transition">S</div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" wire:model="attendanceData.{{ $santri->id }}" value="Alpha" class="peer sr-only">
                                        <div class="w-8 h-8 rounded flex items-center justify-center font-bold text-sm border border-gray-200 text-gray-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-600 transition">A</div>
                                    </label>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" wire:model="notes.{{ $santri->id }}" placeholder="Ket..." 
                                       class="w-full text-xs border-gray-200 rounded focus:ring-pesantren-500 focus:border-pesantren-500 py-1">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg flex items-center gap-2">
                <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                <span wire:loading.remove>Simpan Absensi</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>