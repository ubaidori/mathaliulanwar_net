<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-slate-800 mb-4">Kabar & Karya Santri</h1>
            <p class="text-gray-600 mb-8">Ikuti perkembangan terbaru dan kreativitas santri Mathali'ul Anwar.</p>

            <div class="flex flex-col md:flex-row justify-center gap-4 max-w-2xl mx-auto">
                <div class="inline-flex rounded-lg shadow-sm p-1 border border-gray-200">
                    <button wire:click="$set('kategori', '')" 
                            class="px-4 py-2 rounded-md text-sm font-medium transition {{ $kategori == '' ? 'bg-pesantren-primary text-emerald-700' : 'text-gray-600 hover:bg-green-100' }}">
                        Semua
                    </button>
                    <button wire:click="$set('kategori', 'berita')" 
                            class="px-4 py-2 rounded-md text-sm font-medium transition {{ $kategori == 'berita' ? 'bg-pesantren-primary text-emerald-700' : 'text-gray-600 hover:bg-green-100' }}">
                        Berita
                    </button>
                    <button wire:click="$set('kategori', 'mading')" 
                            class="px-4 py-2 rounded-md text-sm font-medium transition {{ $kategori == 'mading' ? 'bg-pesantren-primary text-emerald-700' : 'text-gray-600 hover:bg-green-100' }}">
                        Mading
                    </button>
                </div>

                <div class="relative w-full md:w-64">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul..." 
                           class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 hover:border-green-400 hover:bg-green-[20] transition">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col h-full">
                
                <a href="{{ route('public.berita.show', $post->slug) }}" class="block relative h-48 overflow-hidden bg-gray-200">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover transition transform hover:scale-105 duration-500">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide text-white 
                        {{ $post->category == 'berita' ? 'bg-emerald-500' : 'bg-yellow-500' }}">
                        {{ $post->category }}
                    </span>
                </a>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center text-xs text-gray-500 mb-3 space-x-2">
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                        <span>&bull;</span>
                        <span class="text-pesantren-primary font-medium">{{ $post->writer ?? 'Admin' }}</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight hover:text-pesantren-primary transition">
                        <a href="{{ route('public.berita.show', $post->slug) }}">
                            {{ Str::limit($post->title, 60) }}
                        </a>
                    </h3>

                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('public.berita.show', $post->slug) }}" class="text-pesantren-600 font-semibold text-sm hover:underline">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <p class="text-gray-500 text-lg">Belum ada berita yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>