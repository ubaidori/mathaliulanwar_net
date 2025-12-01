<div class="bg-gray-50 min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 md:mt-8">
        
        <!-- MOBILE: tombol toggle menu & title compact -->
        <div class="lg:hidden mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $page->title }}</h1>
                    <p class="text-xs text-gray-500">Pondok Pesantren Mathali'ul Anwar</p>
                </div>
                <button id="menuToggle" aria-expanded="false" class="inline-flex items-center px-3 py-2 border rounded-lg text-sm bg-white shadow-sm hover:bg-green-50">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span class="ml-2 text-sm text-gray-700">Menu Profil</span>
                </button>
            </div>

            <div id="mobileMenu" class="mt-3 space-y-2 hidden">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3">
                    <ul class="flex gap-2 overflow-x-auto">
                        @foreach($allPages as $menu)
                            <li class="flex-none">
                                <a href="{{ route('public.profil', $menu->key) }}" 
                                   class="inline-block px-3 py-2 rounded-lg text-sm font-medium whitespace-nowrap 
                                   {{ $page->key == $menu->key 
                                      ? 'bg-green-700 text-white shadow-md' 
                                      : 'text-gray-600 hover:bg-green-100 hover:text-pesantren-primary' }}">
                                    {{ $menu->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12">

            <div class="lg:col-span-3 order-2 lg:order-1">
                <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-100 p-5 sticky top-24">
                    <h3 class="font-bold text-slate-800 mb-4 text-lg border-b pb-2">Menu Profil</h3>
                    <ul class="space-y-2">
                        @foreach($allPages as $menu)
                            <li>
                                <a href="{{ route('public.profil', $menu->key) }}" 
                                   class="block px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 
                                   {{ $page->key == $menu->key 
                                      ? 'bg-green-700 text-white shadow-md' 
                                      : 'text-slate-800 hover:bg-green-100 hover:text-pesantren-primary' }}">
                                    {{ $menu->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-8 p-4 bg-pesantren-50 rounded-lg border border-pesantren-100">
                        <p class="text-xs text-pesantren-800 font-semibold mb-1">Butuh Informasi?</p>
                        <p class="text-xs text-gray-600 mb-2">Hubungi sekretariat kami untuk info pendaftaran.</p>
                        <a href="/kontak" class="text-xs text-pesantren-600 font-bold hover:underline">Hubungi Kami &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-9 order-1 lg:order-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 px-6 md:px-10 py-6 md:py-10">
                    
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-1 font-inter">{{ $page->title }}</h1>
                            <p class="text-sm md:text-base text-gray-500">Pondok Pesantren Mathali'ul Anwar</p>
                        </div>
                        @if($page->image)
                            <div class="mt-4 md:mt-0 md:ml-6 shrink-0">
                                <img src="{{ asset('storage/' . $page->image) }}" 
                                     alt="{{ $page->title }}" 
                                     class="rounded-xl shadow-md w-full md:w-64 lg:w-72 h-44 md:h-48 lg:h-56 object-cover object-center border border-gray-200">
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-800 mb-8">
                        <div class="trix-content text-gray-700 leading-relaxed space-y-4 text-base md:text-lg">
                            {!! $page->content !!}
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex items-center gap-4 flex-wrap">
                        <span class="text-sm text-gray-500 font-medium">Bagikan:</span>

                        <!-- WhatsApp -->
                        <button onclick="shareTo('whatsapp')" title="Bagikan via WhatsApp" class="text-green-600 hover:text-green-800 inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.89 11.89 0 0012 .75 11.93 11.93 0 001.5 10.5c0 2.07.54 4.01 1.56 5.72L.75 23.25l6.2-2.05A11.93 11.93 0 0012 21.75c6.59 0 11.97-5.38 11.97-11.97 0-3.2-1.25-6.2-3.45-8.3zM12 20.25c-1.6 0-3.12-.42-4.48-1.22l-.32-.18-3.68 1.21.99-3.39-.21-.35A8.997 8.997 0 013 10.5c0-4.97 4.03-9 9-9s9 4.03 9 9-4.03 9-9 9z"/><path d="M17.1 14.56c-.28-.14-1.66-.82-1.92-.92-.26-.11-.45-.14-.64.14-.18.28-.7.92-.86 1.11-.16.18-.33.2-.61.07-.28-.14-1.17-.43-2.23-1.37-.82-.73-1.37-1.63-1.53-1.91-.16-.28-.02-.43.12-.57.12-.12.28-.32.43-.48.14-.16.18-.28.28-.46.1-.18.05-.34-.03-.48-.08-.14-.64-1.54-.88-2.12-.23-.55-.47-.48-.64-.49l-.54-.01c-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.27 0 1.34.97 2.64 1.11 2.82.14.18 1.92 3.06 4.65 4.29 3.25 1.44 3.25 0 3.83-.47.58-.47 1.88-1.71 2.15-2.67.27-.96.27-1.77.19-1.94-.08-.17-.28-.28-.56-.42z"/></svg>
                            <span class="sr-only">WhatsApp</span>
                        </button>

                        <!-- Instagram -->
                        <button onclick="shareTo('instagram')" title="Buka Instagram" class="text-pink-600 hover:text-pink-800 inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.85-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28-.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            <span class="sr-only">Instagram</span>
                        </button>

                        <!-- Fallback: native share -->
                        <button onclick="nativeShare()" class="text-gray-500 hover:text-gray-700 text-sm px-2 py-1 rounded">Bagikan Lainnya</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Toggle mobile menu
    (function(){
        const btn = document.getElementById('menuToggle');
        const menu = document.getElementById('mobileMenu');
        if(btn && menu){
            btn.addEventListener('click', function(){
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', String(!expanded));
                menu.classList.toggle('hidden');
            });
        }
    })();

    // Ganti dengan handle Instagram Anda (tanpa @) jika ingin buka profil langsung.
    const instagramHandle = ''; // contoh: 'mathaliulanwar'

    function shareTo(platform){
        const title = document.querySelector('h1')?.innerText || '{{ $page->title }}';
        const url = window.location.href;
        const text = encodeURIComponent(title + ' - ' + url);

        if(platform === 'whatsapp'){
            const wa = 'https://wa.me/?text=' + text;
            window.open(wa, '_blank');
            return;
        }

        if(platform === 'instagram'){
            if(instagramHandle){
                window.open('https://instagram.com/' + instagramHandle.replace(/^@/,'') , '_blank');
            } else if (navigator.share) {
                navigator.share({ title, url }).catch(()=>{ window.open('https://instagram.com', '_blank'); });
            } else {
                window.open('https://instagram.com', '_blank');
            }
            return;
        }
    }

    function nativeShare(){
        const title = document.querySelector('h1')?.innerText || '{{ $page->title }}';
        const url = window.location.href;
        if(navigator.share){
            navigator.share({ title, url }).catch(()=>{ alert('Gagal membuka share dialog'); });
        } else {
            navigator.clipboard?.writeText(title + ' - ' + url).then(function(){
                alert('Tautan disalin ke clipboard.');
            }, function(){
                alert('Tidak dapat menyalin. Silakan salin tautan secara manual: ' + url);
            });
        }
    }
</script>