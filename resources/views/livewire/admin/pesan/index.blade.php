<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kotak Masuk</h2>
            <p class="text-gray-500 text-sm">Daftar pesan dari pengunjung website.</p>
        </div>
        
        <div class="bg-pesantren-100 text-pesantren-800 px-4 py-2 rounded-lg font-bold text-sm">
            Total: {{ $messages->total() }} Pesan
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider border-b">
                    <tr>
                        <th class="px-6 py-4">Pengirim</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4 w-1/3">Isi Pesan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-gray-50 transition group">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $msg->name }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col text-sm">
                                <a href="mailto:{{ $msg->email }}" class="text-indigo-600 hover:underline">{{ $msg->email }}</a>
                                <span class="text-gray-500">{{ $msg->phone ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-normal min-w-[300px]">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ Str::limit($msg->message, 80) }}
                            </p>
                            <div class="hidden group-hover:block absolute bg-gray-800 text-white text-xs p-2 rounded shadow-lg z-10 max-w-sm mt-1">
                                {{ $msg->message }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-xs text-gray-500 font-mono">
                            {{ $msg->created_at->format('d M Y') }} <br>
                            {{ $msg->created_at->format('H:i') }}
                        </td>

                        <td>
                            @if ($msg->status == 1)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">Terbaca</span>
                                @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">Belum Terbaca</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="" wire:click.prevent="markAsRead({{ $msg->id }})"
                                   class="text-blue-600 hover:text-blue-800" title="Tandai sebagai Terbaca">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </a>
                                
                                @if($msg->phone)
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $msg->phone) }}" target="_blank" 
                                   class="text-green-600 hover:text-green-800" title="Balas via WA">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>
                                @endif

                                <button wire:click="delete({{ $msg->id }})" 
                                        wire:confirm="Hapus pesan dari {{ $msg->name }}?" 
                                        class="text-red-500 hover:text-red-700" title="Hapus Pesan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>