<div class="bg-white min-h-screen pb-16">
    
    @if($post->image)
    <div class="w-full h-64 md:h-96 relative z-0">
        <div class="absolute inset-0 bg-black opacity-40 z-10"></div> <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover">
        
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-12 z-20 text-white max-w-5xl mx-auto">
            <div class="flex items-center space-x-4 mb-3 text-sm md:text-base">
                <span class="bg-pesantren-primary px-3 py-1 rounded-full font-bold uppercase text-xs">
                    {{ $post->category }}
                </span>
                <span>{{ $post->created_at->format('d F Y') }}</span>
            </div>
            <h1 class="text-2xl md:text-4xl font-bold leading-tight shadow-black">
                {{ $post->title }}
            </h1>
        </div>
    </div>
    @else
    <div class="bg-pesantren-dark text-white py-12 px-4 text-center">
        <h1 class="text-2xl md:text-4xl font-bold max-w-4xl mx-auto">{{ $post->title }}</h1>
        <p class="mt-4 opacity-80">{{ $post->created_at->format('d F Y') }}</p>
    </div>
    @endif

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-30">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-10 border border-gray-100">
            
            <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-pesantren-100 flex items-center justify-center text-pesantren-600 font-bold">
                        {{ substr($post->writer ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm text-gray-900 font-bold">Penulis: {{ $post->writer ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Tim Redaksi Mathali'ul Anwar</p>
                    </div>
                </div>
                
                <a href="{{ route('public.berita.index') }}" class="text-sm text-gray-500 hover:text-pesantren-primary flex items-center gap-1">
                    &larr; <span class="hidden sm:inline">Kembali ke Berita</span>
                </a>
            </div>

            <article class="prose prose-lg prose-green max-w-none text-gray-700 leading-relaxed">
                <div class="trix-content">
                    {!! $post->content !!}
                </div>
            </article>

            <div class="mt-10 pt-6 border-t border-gray-100">
                <h4 class="text-sm font-bold text-gray-800 mb-3">Bagikan tulisan ini:</h4>
                <div class="flex gap-2">
                    <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Facebook</a>
                    <a href="#" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">WhatsApp</a>
                    <a href="#" class="bg-pink-500 text-white px-3 py-1 rounded text-sm hover:bg-pink-600">Instagram</a>
                </div>
            </div>

        </div>
    </div>
</div>