<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6">

    {{-- CSS FIX untuk Rich Text Editor (Trix) Dark Mode --}}
    <style>
        .dark trix-editor, 
        .dark .trix-content {
            background-color: #09090b !important; /* Zinc-950 */
            color: #e4e4e7 !important; /* Zinc-200 */
            border-color: #27272a !important; /* Zinc-800 */
        }
        .dark trix-toolbar {
            background-color: #27272a !important; /* Zinc-800 */
            border-bottom: 1px solid #3f3f46 !important; /* Zinc-700 */
        }
        .dark trix-toolbar .trix-button {
            filter: invert(1) brightness(2);
        }
        .dark trix-toolbar .trix-button.trix-active {
            background-color: #3f3f46 !important;
        }
    </style>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Edit Berita</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Memperbarui artikel: <span class="font-semibold text-zinc-700 dark:text-zinc-300">{{ $title }}</span>
            </p>
        </div>
        
        <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form wire:submit="update">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <x-card class="p-6 space-y-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Judul Artikel</label>
                        <input wire:model="title" type="text"
                               class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3">
                        @error('title') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Isi Konten</label>
                        <div class="rounded-lg overflow-hidden border border-zinc-300 dark:border-zinc-700 shadow-sm">
                            <div class="bg-white dark:bg-zinc-950 text-zinc-900 dark:text-white min-h-[350px]">
                                <x-input.rich-text wire:model="content" :value="$content" />
                            </div>
                        </div>
                        @error('content') <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </x-card>
                
                <div class="hidden lg:flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold text-sm rounded-lg hover:bg-zinc-800 dark:hover:bg-zinc-200 transition shadow-lg transform active:scale-95">
                        <span wire:loading.remove>Simpan Perubahan</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <x-card class="p-6 space-y-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    <h3 class="text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider border-b border-zinc-100 dark:border-zinc-800 pb-3">
                        Pengaturan Publikasi
                    </h3>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Penulis</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            <input wire:model="writer" type="text"
                                class="block w-full pl-9 rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                        </div>
                        @error('writer') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kategori</label>
                        <select wire:model="category" 
                                class="block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                            <option value="berita">Berita Pesantren</option>
                            <option value="mading">Mading / Karya Santri</option>
                        </select>
                        @error('category') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>
                </x-card>

                <x-card class="p-6 space-y-4 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    <h3 class="text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-2">
                        Gambar Utama
                    </h3>
                    
                    <div class="relative group">
                        <input wire:model="image" type="file" id="post-image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        
                        <div class="border-2 border-dashed border-zinc-300 dark:border-zinc-700 rounded-xl p-4 text-center group-hover:bg-zinc-50 dark:group-hover:bg-zinc-800 transition-colors flex flex-col items-center justify-center min-h-[150px]">
                            
                            {{-- LOGIKA PREVIEW GAMBAR --}}
                            @if ($image)
                                {{-- Jika ada upload baru --}}
                                <img src="{{ $image->temporaryUrl() }}" class="w-full rounded-lg shadow-sm object-cover max-h-48">
                                <span class="inline-block mt-2 px-2 py-1 text-[10px] font-bold bg-indigo-100 text-indigo-700 rounded">PREVIEW BARU</span>
                            
                            @elseif ($old_image)
                                {{-- Jika tidak ada upload baru, tampilkan gambar lama --}}
                                <img src="{{ asset('storage/' . $old_image) }}" class="w-full rounded-lg shadow-sm object-cover max-h-48">
                                <p class="text-xs text-zinc-400 mt-2">Gambar Saat Ini</p>
                            
                            @else
                                {{-- Jika tidak ada gambar sama sekali --}}
                                <svg class="w-10 h-10 text-zinc-400 dark:text-zinc-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium text-zinc-900 dark:text-white">Upload Gambar</span>
                            @endif

                        </div>
                    </div>
                    @error('image') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </x-card>

                <div class="lg:hidden">
                    <button type="submit" class="w-full bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold px-6 py-3 rounded-lg shadow-lg">
                        <span wire:loading.remove>Simpan Perubahan</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>