<div>
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 ">Data Santri</h2>
            <p class="text-sm text-gray-500 ">Kelola data santri aktif dan alumni.</p>
        </div>

        <a href="{{ route('admin.santri.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-lg shadow-emerald-500/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Santri
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200  mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Nama atau NIS..." 
               class="w-full md:w-1/3 px-4 py-2 bg-gray-200 rounded-lg border border-gray-300 text-gray-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 hover:bg-gray-100 hover:text-gray-900 outline-none transition">
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">NIS</th>
                        <th class="px-6 py-4">Nama Santri</th>
                        <th class="px-6 py-4">L/P</th>
                        <th class="px-6 py-4">Wali</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 ">
                    @forelse($santris as $santri)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 text-sm font-mono text-gray-600">
                            {{ $santri->nis ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900 ">{{ $santri->name }}</div>
                            <div class="text-xs text-gray-500 -400">{{ $santri->address ?? 'Alamat belum diisi' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-bold rounded {{ $santri->gender == 'L' ? 'bg-blue-100 text-blue-700 ' : 'bg-pink-100 text-pink-700 -900/30 -400' }}">
                                {{ $santri->gender }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $santri->father_name ?? $santri->mother_name ?? '-' }}
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
                            <a href="{{ route('admin.santri.edit', $santri->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>

                            <button wire:click="delete({{ $santri->id }})" 
                                    wire:confirm="Apakah Anda yakin ingin menghapus data santri ini? Data yang dihapus tidak bisa dikembalikan." 
                                    class="text-red-600 hover:text-red-800" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data santri.
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