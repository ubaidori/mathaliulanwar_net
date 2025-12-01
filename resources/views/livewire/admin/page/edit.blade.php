<div class="max-w-6xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit: {{ $title }}</h2>
        <a href="{{ route('admin.pages.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-1 text-sm">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <form wire:submit="update">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-4">
                
                <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Halaman</label>
                        <input wire:model="title" type="text" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring-pesantren-primary p-2 border">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                        <x-input.rich-text wire:model="content" :value="$content" />
                        @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-emerald-600 cursor-pointer w-full sm:w-auto bg-pesantren-primary text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-medium shadow-lg flex justify-center">
                        <span wire:loading.remove>Simpan Perubahan</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-100 sticky top-6">
                    <h3 class="text-sm font-bold text-gray-700 uppercase mb-4 tracking-wider">Gambar Halaman</h3>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition">
                        <input wire:model="image" type="file" id="page-image" class="hidden">
                        <label for="page-image" class="cursor-pointer flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm text-pesantren-primary font-medium">Upload Gambar</span>
                            <span class="text-xs text-gray-500 mt-1">Maks. 2MB</span>
                        </label>
                    </div>

                    <div class="mt-4">
                        @if ($image)
                            <p class="text-xs text-gray-500 mb-2 text-center">Preview Baru:</p>
                            <img src="{{ $image->temporaryUrl() }}" class="w-full rounded-lg shadow-md">
                        @elseif ($old_image)
                            <p class="text-xs text-gray-500 mb-2 text-center">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $old_image) }}" class="w-full rounded-lg shadow-md">
                        @else
                            <div class="h-32 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                Belum ada gambar
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>