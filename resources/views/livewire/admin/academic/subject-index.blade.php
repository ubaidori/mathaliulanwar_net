<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Mata Pelajaran</h2>
            <p class="text-sm text-gray-500">Daftar pelajaran Diniyah.</p>
        </div>
        <button wire:click="create" class="bg-pesantren-500 hover:bg-pesantren-600 text-white px-4 py-2 rounded-lg shadow-lg">
            + Tambah Mapel
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('message') }}</div>
    @endif

    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Mapel..." 
               class="w-full md:w-1/3 px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-pesantren-500 outline-none">
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Kode</th>
                    <th class="px-6 py-4">Nama Pelajaran</th>
                    <th class="px-6 py-4">Keterangan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($subjects as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-mono text-sm text-gray-600">{{ $item->code ?? '-' }}</td>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $item->description ?? '-' }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="text-blue-600 font-medium">Edit</button>
                        <button wire:click="delete({{ $item->id }})" wire:confirm="Hapus mapel ini?" class="text-red-500 font-medium">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-gray-800">
                {{ $isEdit ? 'Edit Mapel' : 'Tambah Mapel Baru' }}
            </h3>
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <label class="text-sm font-medium text-gray-700">Kode</label>
                        <input wire:model="code" type="text" placeholder="NHW" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                    </div>
                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-700">Nama Mapel</label>
                        <input wire:model="name" type="text" placeholder="Nahwu" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea wire:model="description" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500"></textarea>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500">Batal</button>
                    <button type="submit" class="bg-pesantren-500 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>