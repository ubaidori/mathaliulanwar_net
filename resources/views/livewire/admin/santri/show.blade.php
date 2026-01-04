<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Profil Santri</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Detail informasi data diri dan akademik.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.santri.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800 text-sm font-medium transition shadow-sm">
                &larr; Kembali
            </a>
            <a href="{{ route('admin.santri.edit', $santri->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition shadow-md gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-6 flex flex-col items-center text-center relative overflow-hidden">
                
                {{-- Status Badge (Absolute Top) --}}
                @if($santri->drop_date)
                    <div class="absolute top-0 left-0 w-full bg-red-100 dark:bg-red-900/30 border-b border-red-200 dark:border-red-800 py-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-red-700 dark:text-red-400">
                            Non-Aktif / Boyong
                        </span>
                    </div>
                @else
                    <div class="absolute top-0 right-0 mt-4 mr-4">
                        <span class="flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                    </div>
                @endif

                <div class="mt-6 mb-4 relative group">
                    <div class="w-40 h-52 bg-zinc-100 dark:bg-zinc-800 rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 shadow-inner mx-auto">
                        @if($santri->photo)
                            <img src="{{ asset('storage/' . $santri->photo) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-600">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-xs font-medium">No Photo</span>
                            </div>
                        @endif
                    </div>
                </div>

                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $santri->name }}</h3>
                <p class="text-zinc-500 dark:text-zinc-400 text-sm font-mono mt-1 bg-zinc-100 dark:bg-zinc-800 px-2 py-0.5 rounded inline-block">
                    NIS: {{ $santri->nis ?? '-' }}
                </p>

                @if($santri->drop_date)
                    <div class="mt-4 p-3 bg-red-50 dark:bg-red-900/10 rounded-lg border border-red-100 dark:border-red-900/30 w-full text-left">
                        <p class="text-xs text-red-600 dark:text-red-400 font-semibold mb-1">Informasi Boyong:</p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">Tgl: {{ $santri->drop_date->format('d M Y') }}</p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400 italic">"{{ $santri->drop_reason ?? '-' }}"</p>
                    </div>
                @endif
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-5">
                <h4 class="text-xs font-bold text-zinc-500 dark:text-zinc-500 uppercase tracking-wider mb-4 border-b border-zinc-100 dark:border-zinc-800 pb-2">
                    Posisi Saat Ini
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Asrama</p>
                            @if($santri->dorm_id)
                                <?php $dorm = \App\Models\Dorm::find($santri->dorm_id); ?>
                                <p class="text-sm font-bold text-zinc-800 dark:text-zinc-200">Blok {{ $dorm->block }} - {{ $dorm->room_number }}</p>
                            @else
                                <p class="text-sm text-zinc-400">-</p>
                            @endif
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 dark:text-purple-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Kelas Diniyah</p>
                            @if($santri->islamic_class_id)
                                <?php $cls = \App\Models\IslamicClass::find($santri->islamic_class_id); ?>
                                <p class="text-sm font-bold text-zinc-800 dark:text-zinc-200">{{ $cls->name }} {{ $cls->class }}</p>
                            @else
                                <p class="text-sm text-zinc-400">-</p>
                            @endif
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-lg text-orange-600 dark:text-orange-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Tanggal Masuk</p>
                            <p class="text-sm font-bold text-zinc-800 dark:text-zinc-200">
                                {{ date('d M Y', strtotime($santri->registration_date)) }}    
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="bg-zinc-50 dark:bg-zinc-800/50 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 flex items-center justify-between">
                    <h3 class="font-bold text-zinc-800 dark:text-white text-base">Data Pribadi</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                        <div class="col-span-1">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">NISN</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100 font-mono">{{ $santri->nisn ?? '-' }}</dd>
                        </div>
                        <div class="col-span-1">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                @if($santri->gender == 'L')
                                    <span class="inline-flex items-center gap-1">Laki-laki <svg class="w-3 h-3 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10H12V2z"></path></svg></span>
                                @else
                                    <span class="inline-flex items-center gap-1">Perempuan <svg class="w-3 h-3 text-pink-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v6"></path><path d="M8 19h8"></path></svg></span>
                                @endif
                            </dd>
                        </div>
                        <div class="col-span-1">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Tempat, Tanggal Lahir</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                {{ $santri->dob ? $santri->dob->format('d M Y') : '-' }} 
                                @if($santri->dob)
                                    <span class="text-zinc-400 dark:text-zinc-500 font-normal text-xs ml-1">({{ $santri->dob->age }} Th)</span>
                                @endif
                            </dd>
                        </div>
                        <div class="col-span-1">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Pendidikan Terakhir</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $santri->education ?? '-' }}</dd>
                        </div>
                        <div class="col-span-1">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Info Keluarga</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-200">
                                Anak ke-<strong class="font-semibold">{{ $santri->th_child ?? '?' }}</strong> dari {{ $santri->siblings_count ?? '?' }} bersaudara
                            </dd>
                        </div>
                        <div class="col-span-1 sm:col-span-2 bg-zinc-50 dark:bg-zinc-800/30 p-4 rounded-lg border border-zinc-100 dark:border-zinc-800">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide mb-1">Alamat Lengkap</dt>
                            <dd class="text-sm text-zinc-800 dark:text-zinc-200 leading-relaxed">{{ $santri->address ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="bg-zinc-50 dark:bg-zinc-800/50 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <h3 class="font-bold text-zinc-800 dark:text-white text-base">Data Orang Tua</h3>
                </div>
                <div class="p-0 grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-zinc-200 dark:divide-zinc-700">
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Ayah</span>
                        </div>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-xs text-zinc-500 dark:text-zinc-400">Nama Lengkap</dt>
                                <dd class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $santri->father_name ?? '-' }}</dd>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Status</dt>
                                    <dd class="text-sm font-medium {{ ($santri->father_alive == 'Meninggal') ? 'text-red-600' : 'text-zinc-800 dark:text-zinc-200' }}">
                                        {{ $santri->father_alive ?? '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Pekerjaan</dt>
                                    <dd class="text-sm font-medium text-zinc-800 dark:text-zinc-200">{{ $santri->father_job ?? '-' }}</dd>
                                </div>
                            </div>
                            <div>
                                <dt class="text-xs text-zinc-500 dark:text-zinc-400">No. Telepon</dt>
                                <dd class="text-sm font-medium text-zinc-800 dark:text-zinc-200 flex items-center gap-2">
                                    @if($santri->father_phone)
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $santri->father_phone }}
                                    @else
                                        <span class="text-zinc-400">-</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-pink-100 text-pink-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Ibu</span>
                        </div>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-xs text-zinc-500 dark:text-zinc-400">Nama Lengkap</dt>
                                <dd class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $santri->mother_name ?? '-' }}</dd>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Status</dt>
                                    <dd class="text-sm font-medium {{ ($santri->mother_alive == 'Meninggal') ? 'text-red-600' : 'text-zinc-800 dark:text-zinc-200' }}">
                                        {{ $santri->mother_alive ?? '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">Pekerjaan</dt>
                                    <dd class="text-sm font-medium text-zinc-800 dark:text-zinc-200">{{ $santri->mother_job ?? '-' }}</dd>
                                </div>
                            </div>
                            <div>
                                <dt class="text-xs text-zinc-500 dark:text-zinc-400">No. Telepon</dt>
                                <dd class="text-sm font-medium text-zinc-800 dark:text-zinc-200 flex items-center gap-2">
                                    @if($santri->mother_phone)
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $santri->mother_phone }}
                                    @else
                                        <span class="text-zinc-400">-</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                </div>
            </div>

            @if($santri->guardian_name)
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="bg-yellow-50 dark:bg-yellow-900/10 px-6 py-4 border-b border-yellow-100 dark:border-yellow-900/30">
                    <h3 class="font-bold text-yellow-800 dark:text-yellow-200 text-base">Data Wali</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Nama Wali</dt>
                            <dd class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $santri->guardian_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Hubungan</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $santri->guardian_relationship }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Pekerjaan</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $santri->guardian_job ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">No. Telepon</dt>
                            <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">{{ $santri->guardian_phone ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>