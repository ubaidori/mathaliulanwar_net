<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6">
    
    {{-- FIX 1: Hapus @fluxStyles jika ada di file ini atau layout --}}
    {{-- CSS FIX untuk Rich Text Editor (Trix/Quill) agar support Dark Mode --}}
    <style>
        /* Memaksa area editor menjadi gelap saat dark mode */
        .dark trix-editor, 
        .dark .trix-content {
            background-color: #09090b !important; /* Zinc-950 */
            color: #e4e4e7 !important; /* Zinc-200 */
            border-color: #27272a !important; /* Zinc-800 */
        }
        /* Memaksa Toolbar menjadi abu-abu gelap */
        .dark trix-toolbar {
            background-color: #27272a !important; /* Zinc-800 */
            border-bottom: 1px solid #3f3f46 !important; /* Zinc-700 */
        }
        .dark trix-toolbar .trix-button {
            background-color: transparent !important;
            filter: invert(1) brightness(2); /* Membuat icon tombol jadi putih */
        }
        .dark trix-toolbar .trix-button.trix-active {
            background-color: #3f3f46 !important; /* Highlight tombol aktif */
        }
    </style>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Edit Halaman</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Memperbarui konten untuk: <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ $title }}</span>
            </p>
        </div>
        
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form wire:submit="update">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                {{-- FIX 2: Tambahkan overflow-hidden dan border yang jelas pada card --}}
                <x-card class="p-6 space-y-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    
                    {{-- FIX 3: Pastikan input background lebih gelap (Zinc-950) daripada Card (Zinc-900) agar terlihat "masuk" --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Judul Halaman</label>
                        <input wire:model="title" type="text" 
                               class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3">
                        @error('title') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Isi Konten
                        </label>
                        
                        {{-- Wrapper untuk Editor --}}
                        <div class="rounded-lg overflow-hidden border border-zinc-300 dark:border-zinc-700 shadow-sm">
                            {{-- Class 'dark:bg-zinc-950' di sini penting untuk container editor --}}
                            <div class="bg-white dark:bg-zinc-950 text-zinc-900 dark:text-white min-h-[300px]">
                                <x-input.rich-text wire:model="content" :value="$content" />
                            </div>
                        </div>
                        @error('content') <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 flex justify-end border-t border-zinc-100 dark:border-zinc-800">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold text-sm rounded-lg hover:bg-zinc-800 dark:hover:bg-zinc-200 focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 transition shadow-sm">
                            <span wire:loading.remove>Simpan Perubahan</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>
                </x-card>

            </div>

            <div class="lg:col-span-1">
                <x-card class="p-6 sticky top-6 space-y-4 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    <h3 class="text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-4">
                        Gambar Halaman
                    </h3>
                    
                    <div class="relative group">
                        <input wire:model="image" type="file" id="page-image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        
                        {{-- FIX 4: Warna border dashed dibuat lebih halus di dark mode --}}
                        <div class="border-2 border-dashed border-zinc-300 dark:border-zinc-700 rounded-xl p-6 text-center group-hover:bg-zinc-50 dark:group-hover:bg-zinc-800 transition-colors h-40 flex flex-col items-center justify-center">
                            <div class="space-y-2">
                                <svg class="w-8 h-8 mx-auto text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <div class="text-sm font-medium text-zinc-900 dark:text-white">Upload Gambar</div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">PNG, JPG (Maks. 2MB)</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-zinc-50 dark:bg-zinc-950 p-2 rounded-lg border border-zinc-100 dark:border-zinc-800">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="w-full rounded shadow-sm object-cover">
                        @elseif ($old_image)
                            <img src="{{ asset('storage/' . $old_image) }}" class="w-full rounded shadow-sm object-cover">
                        @else
                            <div class="h-32 flex flex-col items-center justify-center text-zinc-400 text-xs text-center">
                                <span class="block mb-1">📷</span>
                                Belum ada gambar
                            </div>
                        @endif
                    </div>
                </x-card>
            </div>

        </div>
    </form>
</div>