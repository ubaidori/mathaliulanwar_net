<div class="max-w-7xl mx-auto p-4">
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 flex flex-col md:flex-row justify-between items-center gap-4 border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Rekap Kinerja Guru</h1>
            <p class="text-gray-500 text-sm mt-1">Laporan kehadiran berdasarkan jadwal mengajar (Jurnal Kelas).</p>
        </div>
        
        <div class="flex gap-3">
            <select wire:model.live="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->locale('id')->monthName }}</option>
                @endforeach
            </select>

            <select wire:model.live="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                @foreach(range(date('Y'), date('Y')-2) as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Guru</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Jadwal (Jam)</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Hadir</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kosong/Alpha</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Performa</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($teachers as $teacher)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 shrink-0 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                    {{ substr($teacher->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $teacher->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $teacher->nip ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                            {{ $teacher->stats['wajib'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-green-600">
                            {{ $teacher->stats['hadir'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-red-500">
                            {{ $teacher->stats['wajib'] - $teacher->stats['hadir'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @php $p = $teacher->stats['persen']; @endphp
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $p >= 90 ? 'bg-green-100 text-green-800' : ($p >= 70 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $p }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button wire:click="showDetail({{ $teacher->id }})" class="text-blue-600 hover:text-blue-900 font-semibold hover:underline">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada data guru yang aktif.
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
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeDetail"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Detail Kehadiran: <span class="font-bold text-blue-600">{{ $selectedStaff->name }}</span>
                        </h3>
                        <button wire:click="closeDetail" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="max-h-[60vh] overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($detailReport as $row)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <div class="font-medium">{{ $row['date'] }}</div>
                                        <div class="text-xs text-gray-500">{{ $row['day'] }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $row['subject'] }} <br>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $row['class'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $row['time'] }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($row['is_present'])
                                            <span class="px-2 py-1 rounded-full text-xs font-bold text-green-700 bg-green-100">
                                                Hadir
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded-full text-xs font-bold text-red-700 bg-red-100">
                                                Tidak Hadir
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500 italic">
                                        Tidak ada jadwal mengajar pada bulan ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="closeDetail" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>