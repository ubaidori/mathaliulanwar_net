<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Berita</h2>
        <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <form wire:submit="update" class="space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input wire:model="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary border p-2">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Penulis</label>
                <input wire:model="writer" type="text" placeholder="Misal: Redaksi Pesantren" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary border p-2">
                @error('writer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select wire:model="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary border p-2">
                    <option value="berita">Berita Pesantren</option>
                    <option value="mading">Mading / Karya Santri</option>
                </select>
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Utama</label>
                <input wire:model="image" type="file" class="mt-1 block w-full text-sm rounded-full border border-gray-300 text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-pesantren-700 hover:file:bg-gray-300">
                
                <div class="mt-3">
                    @if ($image)
                        <p class="text-xs text-gray-500 mb-1">Preview Gambar Baru:</p>
                        <img src="{{ $image->temporaryUrl() }}" class="h-48 rounded-lg object-cover border border-gray-200">
                    
                    @elseif ($old_image)
                        <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                        <img src="{{ asset('storage/' . $old_image) }}" class="h-48 rounded-lg object-cover border border-gray-200">
                    
                    @else
                        <div class="h-48 w-48 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 border border-dashed border-gray-300">
                            Tidak ada gambar
                        </div>
                    @endif
                </div>

                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                <x-input.rich-text wire:model="content" :value="$content" />
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-lg hover:bg-emerald-700 font-medium shadow-md border border-emerald-500 hover:shadow-lg flex justify-center">
                    <span wire:loading.remove>Perbarui Berita</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>