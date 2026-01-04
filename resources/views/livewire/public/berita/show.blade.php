<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen pb-16 transition-colors duration-300">
    
    @if($post->image)
    <div class="w-full h-[50vh] md:h-[60vh] relative z-0">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent z-10"></div> 
        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
        
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-12 z-20 text-white max-w-5xl mx-auto">
            <div class="flex items-center space-x-3 mb-4 animate-fade-in-up">
                <span class="bg-emerald-600/90 backdrop-blur-sm px-3 py-1 rounded-full font-bold uppercase text-xs tracking-wider shadow-sm">
                    {{ $post->category }}
                </span>
                <span class="text-sm md:text-base opacity-90 font-medium tracking-wide">
                    {{ $post->created_at->translatedFormat('d F Y') }}
                </span>
            </div>
            <h1 class="text-3xl mb-10 md:text-5xl font-extrabold leading-tight shadow-black drop-shadow-lg font-heading">
                {{ $post->title }}
            </h1>
        </div>
    </div>
    @else
    <div class="bg-gradient-to-br from-emerald-800 to-green-900 dark:from-zinc-800 dark:to-zinc-950 text-white py-20 px-4 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto mt-10">
            <span class="inline-block px-3 py-1 mb-4 rounded-full border border-white/30 text-xs font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md">
                {{ $post->category }}
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4">{{ $post->title }}</h1>
            <p class="opacity-80 font-medium">{{ $post->created_at->translatedFormat('d F Y') }}</p>
        </div>
    </div>
    @endif

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-30">
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl dark:shadow-2xl dark:shadow-black/50 p-6 md:p-12 border border-gray-100 dark:border-zinc-700/50 transition-colors duration-300">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-100 dark:border-zinc-700 pb-8 mb-8 gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold text-lg ring-2 ring-emerald-50 dark:ring-emerald-900">
                        {{ substr($post->writer ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-base text-gray-900 dark:text-white font-bold">{{ $post->writer ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 dark:text-zinc-400 font-medium">Tim Redaksi Mathali'ul Anwar</p>
                    </div>
                </div>
                
                <a href="{{ route('public.berita.index') }}" class="group flex items-center gap-2 text-sm text-gray-500 dark:text-zinc-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-medium">Kembali ke Berita</span>
                </a>
            </div>

            <article class="prose prose-lg prose-emerald dark:prose-invert max-w-none text-gray-700 dark:text-zinc-300 leading-relaxed break-words">
                <div class="trix-content">
                    {!! $post->content !!}
                </div>
            </article>

            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-zinc-700">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <h4 class="text-sm font-bold text-gray-800 dark:text-zinc-200 uppercase tracking-wide">
                        Bagikan Artikel Ini:
                    </h4>
                    
                    <div class="flex items-center gap-3">
                        <a href="https://wa.me/?text={{ urlencode($post->title) }}%20{{ urlencode(url()->current()) }}" 
                           target="_blank" 
                           class="w-10 h-10 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm"
                           title="Bagikan ke WhatsApp">
                           <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank" 
                           class="w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm"
                           title="Bagikan ke Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>

                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" 
                           target="_blank" 
                           class="w-10 h-10 rounded-full bg-black hover:bg-gray-800 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm"
                           title="Bagikan ke X (Twitter)">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>

                        <button x-data="{ copied: false }" 
                                @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-10 h-10 rounded-full bg-gray-200 dark:bg-zinc-700 hover:bg-gray-300 dark:hover:bg-zinc-600 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm relative"
                                title="Salin Link">
                            <svg x-show="!copied" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <svg x-show="copied" class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            
                            <span x-show="copied" class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded shadow" style="display: none;">Disalin!</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>