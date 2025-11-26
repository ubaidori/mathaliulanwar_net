<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Berita & Mading</h2>
        <a href="{{ route('admin.posts.create') }}" 
           class="bg-pesantren-primary text-white px-4 py-2 rounded-lg hover:bg-pesantren-hover transition flex items-center gap-2 bg-green-400 font-bold border border-green-500 shadow-md hover:shadow-lg hover:bg-green-500">
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
               class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-pesantren-primary focus:border-pesantren-primary">
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead class="bg-pesantren-50 text-pesantren-dark uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-4">Judul</th>
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
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $post->category == 'berita' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($post->category) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $post->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        <button wire:click="delete({{ $post->id }})" 
                                wire:confirm="Yakin ingin menghapus berita ini?"
                                class="text-red-600 hover:text-red-900 font-medium">
                            Hapus
                        </button>
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