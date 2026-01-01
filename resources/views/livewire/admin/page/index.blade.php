<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Kelola Halaman Profil</h1>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Edit konten statis seperti Sejarah, Visi Misi, dan informasi sekolah lainnya.</p>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Nama Halaman</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Update Terakhir</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($pages as $page)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                        
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-zinc-900 dark:text-white">
                                    {{ $page->title }}
                                </span>
                                <span class="text-xs text-zinc-400 dark:text-zinc-500 font-mono mt-0.5">
                                    key: {{ $page->key }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $page->updated_at->format('d M Y, H:i') }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('admin.pages.edit', $page->id) }}" 
                               class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700 dark:hover:text-indigo-400 transition shadow-sm"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-zinc-500 dark:text-zinc-400">
                            Tidak ada halaman profil yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</div>