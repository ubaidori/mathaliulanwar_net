<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Berita Baru</h2>
        <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <form wire:submit="save" class="space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input wire:model="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary border p-2">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                <label class="block text-sm font-medium text-gray-700">Gambar Utama (Opsional)</label>
                <input wire:model="image" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pesantren-50 file:text-pesantren-700 hover:file:bg-pesantren-100">
                
                @if ($image)
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" class="h-48 rounded-lg object-cover">
                    </div>
                @endif
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Isi Konten</label>
                <textarea wire:model="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary border p-2"></textarea>
                <p class="text-xs text-gray-500 mt-1">*Tips: Nanti kita bisa pasang Text Editor canggih di sini.</p>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-pesantren-primary text-white px-6 py-2 rounded-lg hover:bg-pesantren-hover transition font-medium shadow-md border border-blue-500 bg-blue-500 hover:shadow-lg hover:bg-blue-600">
                    <span wire:loading.remove>Simpan Berita</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>