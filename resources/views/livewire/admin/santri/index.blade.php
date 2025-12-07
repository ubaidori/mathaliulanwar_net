<div>
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Santri</h2>
            <p class="text-sm text-gray-500">Total Data: {{ $santris->total() }} Santri</p>
        </div>
        
        <a href="{{ route('admin.santri.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 shadow-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Santri
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
        
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1 relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Nama atau NIS..." 
                       class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pesantren-500 focus:border-pesantren-500 outline-none transition">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            @if($search || $filterDorm || $filterClass || $filterGender || $filterStatus != 'aktif')
                <button wire:click="resetFilters" class="px-4 py-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg text-sm font-medium transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Reset Filter
                </button>
            @endif
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            
            <div>
                <select wire:model.live="filterStatus" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500 bg-gray-50">
                    <option value="aktif">Santri Aktif</option>
                    <option value="boyong">Alumni / Boyong</option>
                    <option value="">Semua Data</option>
                </select>
            </div>

            <div>
                <select wire:model.live="filterDorm" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500 bg-gray-50">
                    <option value="">Semua Asrama</option>
                    @foreach($dorms as $dorm)
                        <option value="{{ $dorm->id }}">Blok {{ $dorm->block }} - {{ $dorm->room_number }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select wire:model.live="filterClass" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500 bg-gray-50">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $cls)
                        <option value="{{ $cls->id }}">{{ $cls->name }} {{ $cls->class }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select wire:model.live="filterGender" class="w-full text-sm border-gray-300 rounded-lg focus:ring-pesantren-500 bg-gray-50">
                    <option value="">Semua Gender</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Santri</th>
                        <th class="px-6 py-4">Asrama & Kelas</th>
                        <th class="px-6 py-4">Wali</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($santris as $santri)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full overflow-hidden border border-gray-200 bg-gray-100 shrink-0">
                                    @if($santri->photo)
                                        <img src="{{ asset('storage/' . $santri->photo) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-500 font-bold text-xs bg-gray-200">
                                            {{ substr($santri->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">{{ $santri->name }}</div>
                                    <div class="text-xs text-gray-500 font-mono">NIS: {{ $santri->nis ?? '-' }} | {{ $santri->gender }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-xs space-y-1">
                                <div class="flex items-center gap-1 text-gray-700">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    @if($santri->dorm_id)
                                        <?php $d = $dorms->find($santri->dorm_id); ?>
                                        <span>Blok {{ $d->block ?? '?' }} - {{ $d->room_number ?? '?' }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1 text-gray-700">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    @if($santri->islamic_class_id)
                                        <?php $c = $classes->find($santri->islamic_class_id); ?>
                                        <span>{{ $c->name ?? '' }} {{ $c->class ?? '' }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $santri->father_name ?? $santri->guardian_name ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            @if($santri->drop_date)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Non-Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center flex justify-center gap-2">
                            <a href="{{ route('admin.santri.show', $santri->id) }}" class="text-gray-500 hover:text-gray-800 p-1 bg-gray-100 rounded hover:bg-gray-200 transition" title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('admin.santri.edit', $santri->id) }}" class="text-blue-600 hover:text-blue-800 p-1 bg-blue-50 rounded hover:bg-blue-100 transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button wire:click="delete({{ $santri->id }})" wire:confirm="Hapus data ini?" class="text-red-600 hover:text-red-800 p-1 bg-red-50 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p>Tidak ada data santri ditemukan.</p>
                                @if($search || $filterDorm || $filterClass)
                                    <button wire:click="resetFilters" class="text-pesantren-600 font-bold hover:underline mt-2">Reset Filter</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $santris->links() }}
    </div>
</div>