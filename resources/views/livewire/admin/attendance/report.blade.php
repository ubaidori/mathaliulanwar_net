<div class="max-w-6xl mx-auto">
    
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Absensi</h2>
        <p class="text-sm text-gray-500">Rekapitulasi kehadiran santri per mata pelajaran.</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow border border-gray-200 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kelas</label>
                <select wire:model.live="class_id" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}">{{ $c->name }} {{ $c->class }}{{ $c->sub_class }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Mata Pelajaran</label>
                <select wire:model.live="subject_id" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($subjects as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Dari Tanggal</label>
                <input wire:model.live="start_date" type="date" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Sampai Tanggal</label>
                <input wire:model.live="end_date" type="date" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        
        @if(!$class_id || !$subject_id)
            <div class="p-12 text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <p>Silakan pilih <strong>Kelas</strong> dan <strong>Mata Pelajaran</strong> untuk melihat data.</p>
            </div>
        @else
            @if(count($report_dates) == 0)
                <div class="p-12 text-center text-gray-500">
                    <p class="font-bold text-gray-700">Tidak ada data absensi.</p>
                    <p class="text-sm">Mungkin belum ada kegiatan belajar pada rentang tanggal tersebut.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-gray-100 text-gray-700 text-xs uppercase font-bold border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 sticky left-0 bg-gray-100 z-10 w-10">No</th>
                                <th class="px-4 py-3 sticky left-10 bg-gray-100 z-10 border-r w-48">Nama Santri</th>
                                
                                @foreach($report_dates as $date)
                                    <th class="px-2 py-3 text-center border-r min-w-10">
                                        <div>{{ \Carbon\Carbon::parse($date)->format('d') }}</div>
                                        <div class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($date)->format('M') }}</div>
                                    </th>
                                @endforeach

                                <th class="px-2 py-3 text-center bg-green-50 text-green-800 w-10">H</th>
                                <th class="px-2 py-3 text-center bg-blue-50 text-blue-800 w-10">I</th>
                                <th class="px-2 py-3 text-center bg-yellow-50 text-yellow-800 w-10">S</th>
                                <th class="px-2 py-3 text-center bg-red-50 text-red-800 w-10">A</th>
                                <th class="px-2 py-3 text-center border-l w-16">%</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @foreach($report_santris as $index => $santri)
                                @php
                                    $h = 0; $i = 0; $s = 0; $a = 0;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2 sticky left-0 bg-white z-10 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 sticky left-10 bg-white z-10 font-medium border-r">{{ $santri->name }}</td>
                                    
                                    @foreach($report_dates as $date)
                                        @php
                                            $status = $report_data[$santri->id][$date] ?? '-';
                                            if($status == 'Hadir') $h++;
                                            elseif($status == 'Ijin') $i++;
                                            elseif($status == 'Sakit') $s++;
                                            elseif($status == 'Alpha') $a++;
                                        @endphp
                                        <td class="px-2 py-2 text-center border-r">
                                            @if($status == 'Hadir') <span class="text-green-600 font-bold">.</span>
                                            @elseif($status == 'Ijin') <span class="text-blue-600 font-bold">I</span>
                                            @elseif($status == 'Sakit') <span class="text-yellow-600 font-bold">S</span>
                                            @elseif($status == 'Alpha') <span class="text-red-600 font-bold">A</span>
                                            @else <span class="text-gray-300">-</span>
                                            @endif
                                        </td>
                                    @endforeach

                                    <td class="px-2 py-2 text-center font-bold bg-green-50">{{ $h }}</td>
                                    <td class="px-2 py-2 text-center font-bold bg-blue-50">{{ $i }}</td>
                                    <td class="px-2 py-2 text-center font-bold bg-yellow-50">{{ $s }}</td>
                                    <td class="px-2 py-2 text-center font-bold bg-red-50">{{ $a }}</td>
                                    
                                    @php
                                        $totalPertemuan = count($report_dates);
                                        $persen = $totalPertemuan > 0 ? round(($h / $totalPertemuan) * 100) : 0;
                                    @endphp
                                    <td class="px-2 py-2 text-center border-l font-bold {{ $persen < 70 ? 'text-red-600' : 'text-green-600' }}">
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
</div>