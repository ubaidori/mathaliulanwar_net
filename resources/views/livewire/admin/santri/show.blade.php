<div class="max-w-6xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Profil Santri</h2>
            <p class="text-sm text-gray-500">Melihat data lengkap santri.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.santri.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                &larr; Kembali
            </a>
            <a href="{{ route('admin.santri.edit', $santri->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
                <div class="w-40 h-52 bg-gray-100 rounded-lg overflow-hidden mb-4 border border-gray-200 shadow-inner">
                    @if($santri->photo)
                        <img src="{{ asset('storage/' . $santri->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="text-xs">No Photo</span>
                        </div>
                    @endif
                </div>

                <h3 class="text-xl font-bold text-gray-900">{{ $santri->name }}</h3>
                <p class="text-gray-500 text-sm mb-3">NIS: {{ $santri->nis ?? '-' }}</p>

                @if($santri->drop_date)
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold uppercase tracking-wide">
                        Non-Aktif / Boyong
                    </span>
                    <p class="text-xs text-red-500 mt-2">Keluar: {{ $santri->drop_date->format('d M Y') }}</p>
                @else
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">
                        Santri Aktif
                    </span>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h4 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-3">Posisi Saat Ini</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex justify-between">
                        <span class="text-gray-500">Asrama</span>
                        @if($santri->dorm_id)
                            <?php $dorm = \App\Models\Dorm::find($santri->dorm_id); ?>
                            <span class="font-medium text-gray-800">Blok {{ $dorm->block }} - {{ $dorm->room_number }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Kelas Diniyah</span>
                        @if($santri->islamic_class_id)
                            <?php $cls = \App\Models\IslamicClass::find($santri->islamic_class_id); ?>
                            <span class="font-medium text-gray-800">{{ $cls->name }} {{ $cls->class }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Tgl Masuk</span>
                        <span class="font-medium text-gray-800">{{ $santri->registration_date->format('d M Y') }}</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Data Pribadi</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">NISN</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $santri->nisn ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $santri->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Tempat, Tanggal Lahir</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">
                                {{ $santri->dob ? $santri->dob->format('d F Y') : '-' }} 
                                <span class="text-gray-400 font-normal">({{ $santri->dob ? $santri->dob->age . ' Tahun' : '' }})</span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Pendidikan Terakhir</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $santri->education ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Info Keluarga</dt>
                            <dd class="mt-1 text-sm text-gray-900">Anak ke-{{ $santri->th_child ?? '?' }} dari {{ $santri->siblings_count ?? '?' }} bersaudara</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium text-gray-500 uppercase">Alamat Lengkap</dt>
                            <dd class="mt-1 text-sm text-gray-900 leading-relaxed">{{ $santri->address ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Data Orang Tua</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="space-y-4">
                        <h4 class="font-bold text-pesantren-600 text-sm border-b pb-1">AYAH</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs text-gray-500">Nama</dt>
                                <dd class="text-sm font-medium">{{ $santri->father_name ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Status</dt>
                                <dd class="text-sm font-medium">{{ $santri->father_alive ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Pekerjaan</dt>
                                <dd class="text-sm font-medium">{{ $santri->father_job ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">No. Telepon</dt>
                                <dd class="text-sm font-medium text-blue-600">{{ $santri->father_phone ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-bold text-pink-600 text-sm border-b pb-1">IBU</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs text-gray-500">Nama</dt>
                                <dd class="text-sm font-medium">{{ $santri->mother_name ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Status</dt>
                                <dd class="text-sm font-medium">{{ $santri->mother_alive ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Pekerjaan</dt>
                                <dd class="text-sm font-medium">{{ $santri->mother_job ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">No. Telepon</dt>
                                <dd class="text-sm font-medium text-blue-600">{{ $santri->mother_phone ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>

                </div>
            </div>

            @if($santri->guardian_name)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800">Data Wali</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Nama Wali</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $santri->guardian_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Hubungan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $santri->guardian_relationship }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Pekerjaan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $santri->guardian_job ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">No. Telepon</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $santri->guardian_phone ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>