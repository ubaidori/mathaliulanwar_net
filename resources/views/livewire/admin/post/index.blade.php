<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl sm:text-xl font-bold text-gray-800">Daftar Berita & Mading</h2>
        <a href="{{ route('admin.posts.create') }}" 
           class="bg-pesantren-primary sm:text-sm sm:px-2 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition flex items-center gap-2 bg-emerald-600 font-bold border border-green-500 shadow-md hover:shadow-lg">
            + Tambah Baru
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari judul berita..." 
               class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-emerald-500 sm:focus:ring-emerald-500 focus:border-emerald-500 hover:border-emerald-400 hover:bg-emerald-[20] transition">
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-pesantren-50 text-pesantren-dark uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $post->title }}</div>
                        <div class="text-xs text-gray-500">{{ Str::limit($post->slug, 30) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $post->writer ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $post->category == 'berita' ? 'bg-emerald-100 text-emerald-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($post->category) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $post->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center space-x-2 flex justify-center items-center">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 p-2 rounded-full hover:bg-blue-100 transition duration-150 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                        <button wire:click="delete({{ $post->id }})" wire:confirm="Yakin ingin menghapus berita ini?" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition duration-150 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>