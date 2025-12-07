<div x-data="{ showModal: false }" 
     x-on:open-modal.window="showModal = true" 
     x-on:close-modal.window="showModal = false">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tahun Ajaran</h2>
            <p class="text-sm text-gray-500">Atur periode akademik aktif.</p>
        </div>
        <button wire:click="create" class="bg-pesantren-500 hover:bg-pesantren-600 text-white px-4 py-2 rounded-lg shadow-lg">
            + Tambah Periode
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Periode</th>
                    <th class="px-6 py-4">Semester</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($years as $year)
                <tr class="hover:bg-gray-50 transition {{ $year->is_active ? 'bg-green-50' : '' }}">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $year->name }}</td>
                    <td class="px-6 py-4">{{ $year->semester }}</td>
                    <td class="px-6 py-4">
                        @if($year->is_active)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm border border-green-200">
                                ✓ AKTIF
                            </span>
                        @else
                            <button wire:click="activate({{ $year->id }})" class="text-gray-400 hover:text-pesantren-600 text-xs border border-gray-300 px-2 py-1 rounded hover:bg-white transition">
                                Set Aktif
                            </button>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $year->id }})" class="text-blue-600 font-medium">Edit</button>
                        <button wire:click="delete({{ $year->id }})" wire:confirm="Hapus periode ini?" class="text-red-500 font-medium">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold mb-4 text-gray-800">
                {{ $isEdit ? 'Edit Periode' : 'Tambah Tahun Ajaran' }}
            </h3>
            <form wire:submit="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Periode</label>
                    <input wire:model="name" type="text" placeholder="Contoh: 2024/2025" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Semester</label>
                    <select wire:model="semester" class="w-full rounded-lg border-gray-300 focus:ring-pesantren-500">
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-gray-500">Batal</button>
                    <button type="submit" class="bg-pesantren-500 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>