<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Halaman Profil</h2>
        <p class="text-gray-500 text-sm">Edit konten statis seperti Sejarah, Visi Misi, dll.</p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
        <div class="overflow-x-auto"> <table class="w-full text-left border-collapse min-w-[600px]"> <thead class="bg-pesantren-50 text-pesantren-dark uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-4">Nama Halaman</th>
                        <th class="px-6 py-4">Update Terakhir</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pages as $page)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $page->title }}</div>
                            <div class="text-xs text-gray-400 font-mono">key: {{ $page->key }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $page->updated_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.pages.edit', $page->id) }}" 
                               class="inline-block bg-pesantren-100 text-pesantren-700 hover:bg-pesantren-500 hover:text-emerald-700 px-3 py-1 rounded-md text-sm font-medium transition">
                                Edit Konten
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>