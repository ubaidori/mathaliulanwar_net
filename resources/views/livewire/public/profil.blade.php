<div class="bg-gray-50 dark:bg-zinc-950 min-h-screen pb-12 transition-colors duration-300">
    
    <div class="lg:hidden bg-white dark:bg-zinc-900 shadow-sm border-b border-gray-200 dark:border-zinc-800 sticky top-20 z-30 transition-colors">
        <div class="px-4 py-3 flex items-center justify-between" x-data="{ open: false }">
            <div>
                <h1 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">{{ $page->title }}</h1>
                <p class="text-xs text-gray-500 dark:text-zinc-400">Profil Pesantren</p>
            </div>
            
            <button @click="open = !open" class="p-2 rounded-lg bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-zinc-300 focus:outline-none">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div x-show="open" x-cloak 
                 @click.away="open = false"
                 class="absolute top-full left-0 w-full bg-white dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-800 shadow-lg py-2 px-4 space-y-1">
                @foreach($allPages as $menu)
                    <a href="{{ route('public.profil', $menu->key) }}" 
                       class="block px-4 py-3 rounded-lg text-sm font-medium transition-colors
                       {{ $page->key == $menu->key 
                          ? 'bg-green-600 text-white dark:bg-emerald-600' 
                          : 'text-gray-700 dark:text-zinc-300 hover:bg-gray-100 dark:hover:bg-zinc-800' }}">
                        {{ $menu->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 md:mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12">

            <div class="lg:col-span-3 order-2 lg:order-1">
                <div class="hidden lg:block sticky top-28 space-y-6">
                    
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 p-5 overflow-hidden">
                        <h3 class="font-bold text-gray-800 dark:text-white mb-4 text-lg pb-3 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Menu Profil
                        </h3>
                        <ul class="space-y-1">
                            @foreach($allPages as $menu)
                                <li>
                                    <a href="{{ route('public.profil', $menu->key) }}" 
                                       class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group
                                       {{ $page->key == $menu->key 
                                          ? 'bg-green-600 text-white shadow-md shadow-green-200 dark:shadow-none dark:bg-emerald-600' 
                                          : 'text-gray-600 dark:text-zinc-400 hover:bg-green-50 hover:text-green-700 dark:hover:bg-zinc-800 dark:hover:text-emerald-400' }}">
                                        {{ $menu->title }}
                                        
                                        @if($page->key == $menu->key)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="p-5 bg-gradient-to-br from-green-50 to-emerald-100 dark:from-zinc-800 dark:to-zinc-900 rounded-2xl border border-green-100 dark:border-zinc-700">
                        <p class="text-xs text-green-800 dark:text-emerald-400 font-bold uppercase tracking-wider mb-2">Butuh Bantuan?</p>
                        <p class="text-sm text-gray-600 dark:text-zinc-400 mb-3 leading-relaxed">Hubungi sekretariat kami untuk informasi pendaftaran santri baru.</p>
                        <a href="{{ route('public.contact') }}" class="text-sm text-green-700 dark:text-emerald-400 font-bold hover:underline flex items-center gap-1">
                            Hubungi Kami &rarr;
                        </a>
                    </div>

                </div>
            </div>

            <div class="lg:col-span-9 order-1 lg:order-2">
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg dark:shadow-black/50 border border-gray-100 dark:border-zinc-800 px-6 md:px-10 py-8 md:py-12 transition-colors duration-300">
                    
                    <div class="flex flex-col md:flex-row md:items-start justify-between mb-8 gap-6 border-b border-gray-100 dark:border-zinc-800 pb-8">
                        <div class="flex-1">
                            <span class="inline-block py-1 px-3 rounded-full bg-green-100 dark:bg-emerald-900/30 text-green-700 dark:text-emerald-400 text-xs font-bold uppercase tracking-wider mb-3">
                                Profil Pesantren
                            </span>
                            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2 font-inter leading-tight">
                                {{ $page->title }}
                            </h1>
                            <p class="text-gray-500 dark:text-zinc-400 text-lg">Pondok Pesantren Mathali'ul Anwar</p>
                        </div>
                        
                        @if($page->image)
                            <div class="shrink-0 w-full md:w-1/3">
                                <div class="relative rounded-xl overflow-hidden shadow-md group">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                                    <img src="{{ asset('storage/' . $page->image) }}" 
                                         alt="{{ $page->title }}" 
                                         class="w-full h-48 md:h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg prose-green dark:prose-invert max-w-none text-gray-700 dark:text-zinc-300 leading-relaxed">
                        <div class="trix-content">
                            {!! $page->content !!}
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-zinc-800">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <span class="text-sm font-bold text-gray-600 dark:text-zinc-400 uppercase tracking-wide">
                                Bagikan Halaman Ini:
                            </span>
                            
                            <div class="flex items-center gap-2">

                                <a href="https://wa.me/?text={{ urlencode($page->title) }}%20{{ urlencode(url()->current()) }}" 
                                    target="_blank" 
                                    class="w-9 h-9 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm"
                                    title="Bagikan ke WhatsApp">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>

                                <!-- <a href="https://wa.me/?text={{ urlencode($page->title) }}%20{{ urlencode(url()->current()) }}" 
                                   target="_blank"
                                   class="w-9 h-9 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm">
                                   <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                </a> -->

                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank"
                                   class="w-9 h-9 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>

                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($page->title) }}&url={{ urlencode(url()->current()) }}" 
                                   target="_blank"
                                   class="w-9 h-9 rounded-full bg-black hover:bg-gray-800 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-white flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>

                                <button x-data="{ copied: false }" 
                                        @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="w-9 h-9 rounded-full bg-gray-200 dark:bg-zinc-700 hover:bg-gray-300 dark:hover:bg-zinc-600 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-transform hover:-translate-y-1 shadow-sm relative">
                                    <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <svg x-show="copied" class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>