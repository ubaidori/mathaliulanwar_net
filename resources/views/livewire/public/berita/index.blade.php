<div class="min-h-screen py-12 bg-gray-50 dark:bg-zinc-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                Kabar & <span class="text-emerald-600 dark:text-emerald-400">Karya Santri</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-zinc-400 max-w-2xl mx-auto">
                Ikuti perkembangan terbaru, prestasi, dan kreativitas tanpa batas dari para santri Mathali'ul Anwar.
            </p>

            <div class="mt-8 flex flex-col md:flex-row justify-center items-center gap-4 max-w-4xl mx-auto">
                
                <div class="inline-flex bg-white dark:bg-zinc-800 rounded-lg shadow-sm p-1.5 border border-gray-200 dark:border-zinc-700">
                    @foreach(['' => 'Semua', 'berita' => 'Berita', 'mading' => 'Karya Santri'] as $key => $label)
                        <button wire:click="$set('kategori', '{{ $key }}')" 
                                class="px-4 py-2 rounded-md text-sm font-medium transition-all duration-200
                                {{ $kategori == $key 
                                    ? 'bg-emerald-600 text-white shadow-md' 
                                    : 'text-gray-600 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-700' 
                                }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                <div class="relative w-full md:w-72 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" 
                           type="text" 
                           placeholder="Cari judul artikel..." 
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-zinc-700 rounded-lg leading-5 bg-white dark:bg-zinc-800 text-gray-900 dark:text-zinc-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition-colors duration-200 shadow-sm">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="group bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-700/60 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                
                <a href="{{ route('public.berita.show', $post->slug) }}" class="block relative h-52 overflow-hidden bg-gray-200 dark:bg-zinc-700">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-zinc-700 dark:to-zinc-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-emerald-200 dark:text-zinc-500 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm
                            {{ $post->category == 'berita' ? 'bg-emerald-500' : 'bg-orange-500' }}">
                            {{ $post->category }}
                        </span>
                    </div>
                </a>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center text-xs text-gray-500 dark:text-zinc-400 mb-3 space-x-2">
                        <div class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $post->created_at->translatedFormat('d M Y') }}
                        </div>
                        <span>&bull;</span>
                        <div class="flex items-center text-emerald-600 dark:text-emerald-400 font-medium">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ $post->writer ?? 'Admin' }}
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        <a href="{{ route('public.berita.show', $post->slug) }}">
                            {{ Str::limit($post->title, 60) }}
                        </a>
                    </h3>

                    <p class="text-gray-600 dark:text-zinc-400 text-sm mb-4 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 110) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100 dark:border-zinc-700/50 flex justify-between items-center">
                        <a href="{{ route('public.berita.show', $post->slug) }}" class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold text-sm hover:underline">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center">
                    <div class="bg-gray-100 dark:bg-zinc-800 rounded-full p-6 mb-4">
                        <svg class="w-16 h-16 text-gray-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada artikel ditemukan</h3>
                    <p class="text-gray-500 dark:text-zinc-400 mt-1">Coba ubah kata kunci pencarian atau kategori filter Anda.</p>
                    <button wire:click="$set('search', '')" class="mt-4 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-sm font-medium transition">
                        Reset Pencarian
                    </button>
                </div>
            @endforelse
        </div>

        <div class="mt-12 px-4">
            {{ $posts->links() }} 
            </div>
    </div>
</div>