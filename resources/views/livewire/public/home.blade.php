<x-layout>
    <div class="relative bg-zinc-900 h-[85vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D
                 alt="Suasana Pondok" 
                 class="w-full h-full object-cover opacity-50 dark:opacity-30 scale-105 animate-slow-zoom">            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-900/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-900/40 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/20 border border-green-500/30 text-green-300 text-sm font-semibold mb-8 backdrop-blur-md">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                Penerimaan Santri Baru {{ date('Y') }}/{{ date('Y')+1 }} Dibuka
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight drop-shadow-lg">
                Membangun Generasi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-200">Berilmu & Berakhlak</span>
            </h1>
            
            <p class="max-w-2xl text-lg md:text-xl text-gray-300 mb-10 leading-relaxed font-light">
                Pondok Pesantren Mathali'ul Anwar memadukan kurikulum salafiyah dan modern untuk mencetak kader ulama yang intelek dan siap berkarya.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <a href="/pendaftaran" class="group px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full transition-all transform hover:scale-105 shadow-lg shadow-green-900/50 flex items-center justify-center gap-2">
                    Daftar Sekarang
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="#profil" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full backdrop-blur-md border border-white/20 transition-all flex items-center justify-center">
                    Profil Pesantren
                </a>
            </div>
        </div>
    </div>

    <div class="relative -mt-20 z-20 max-w-6xl mx-auto px-4">
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-xl dark:shadow-black/50 border border-gray-100 dark:border-zinc-700 p-8 grid grid-cols-2 md:grid-cols-4 gap-8 text-center backdrop-blur-xl bg-opacity-95">
            <div class="space-y-1">
                <p class="text-4xl font-extrabold text-green-600 dark:text-emerald-400">1.2k+</p>
                <p class="text-xs text-gray-500 dark:text-zinc-400 uppercase tracking-wider font-bold">Santri Mukim</p>
            </div>
            <div class="space-y-1">
                <p class="text-4xl font-extrabold text-green-600 dark:text-emerald-400">85</p>
                <p class="text-xs text-gray-500 dark:text-zinc-400 uppercase tracking-wider font-bold">Guru & Asatidz</p>
            </div>
            <div class="space-y-1">
                <p class="text-4xl font-extrabold text-green-600 dark:text-emerald-400">45</p>
                <p class="text-xs text-gray-500 dark:text-zinc-400 uppercase tracking-wider font-bold">Tahun Mengabdi</p>
            </div>
            <div class="space-y-1">
                <p class="text-4xl font-extrabold text-green-600 dark:text-emerald-400">A</p>
                <p class="text-xs text-gray-500 dark:text-zinc-400 uppercase tracking-wider font-bold">Akreditasi</p>
            </div>
        </div>
    </div>

    <section id="profil" class="py-24 bg-gray-50 dark:bg-zinc-950 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="relative group order-2 lg:order-1">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-green-600 to-emerald-400 rounded-3xl opacity-20 group-hover:opacity-30 blur-lg transition-all duration-500"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white dark:border-zinc-800">
                        <img src="https://ui-avatars.com/api/?name=KH+Abdullah&size=600&background=random" 
                             alt="KH. Abdullah Faqih" 
                             class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-6 pt-20">
                            <h4 class="text-xl font-bold text-white">KH. Abdullah Faqih</h4>
                            <p class="text-emerald-300 text-sm">Pengasuh Pondok Pesantren</p>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 dark:bg-emerald-900/30 text-green-700 dark:text-emerald-400 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-600"></span>
                        Ahlan Wa Sahlan
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        Pendidikan Karakter Berbasis <span class="text-green-600 dark:text-emerald-500 relative whitespace-nowrap">
                            Nilai Islami
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-green-200 dark:text-emerald-900 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" /></svg>
                        </span>
                    </h2>
                    <div class="space-y-6 text-gray-600 dark:text-zinc-300 text-lg leading-relaxed">
                        <p>
                            "Di Mathali'ul Anwar, kami tidak hanya mengajarkan ilmu pengetahuan, tetapi juga menanamkan adab. Ilmu tanpa adab ibarat api tanpa kayu bakar, dan adab tanpa ilmu ibarat jasad tanpa ruh."
                        </p>
                        <p class="font-medium text-gray-800 dark:text-zinc-100">
                            Kami berkomitmen mencetak santri yang tafaqquh fiddin, berwawasan luas, dan siap menjadi perekat umat.
                        </p>
                    </div>
                    
                    <div class="mt-10 flex items-center gap-6">
                        <a href="{{ route('public.profil', 'sejarah') }}" class="text-green-600 dark:text-emerald-400 font-bold hover:underline flex items-center gap-2">
                            Baca Sejarah Lengkap <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white dark:bg-zinc-900 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Program Pendidikan</h2>
                <p class="text-gray-500 dark:text-gray-400">
                    Kurikulum komprehensif yang mengintegrasikan ilmu agama dan umum.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 rounded-3xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-green-600 dark:hover:bg-emerald-600 transition-all duration-300 hover:-translate-y-2 border border-gray-100 dark:border-zinc-700 hover:border-transparent cursor-pointer">
                    <div class="w-16 h-16 bg-white dark:bg-zinc-700 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-white/20 transition-colors">
                        <span class="text-3xl">📖</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white group-hover:text-white">Tahfidzul Qur'an</h3>
                    <p class="text-gray-500 dark:text-zinc-400 group-hover:text-green-100 leading-relaxed">
                        Program intensif menghafal Al-Qur'an 30 Juz dengan metode mutqin dan bersanad.
                    </p>
                </div>

                <div class="group p-8 rounded-3xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-green-600 dark:hover:bg-emerald-600 transition-all duration-300 hover:-translate-y-2 border border-gray-100 dark:border-zinc-700 hover:border-transparent cursor-pointer">
                    <div class="w-16 h-16 bg-white dark:bg-zinc-700 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-white/20 transition-colors">
                        <span class="text-3xl">🕌</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white group-hover:text-white">Madrasah Diniyah</h3>
                    <p class="text-gray-500 dark:text-zinc-400 group-hover:text-green-100 leading-relaxed">
                        Kajian kitab kuning (Fiqh, Nahwu, Shorof) dengan sistem bandongan & sorogan.
                    </p>
                </div>

                <div class="group p-8 rounded-3xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-green-600 dark:hover:bg-emerald-600 transition-all duration-300 hover:-translate-y-2 border border-gray-100 dark:border-zinc-700 hover:border-transparent cursor-pointer">
                    <div class="w-16 h-16 bg-white dark:bg-zinc-700 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-white/20 transition-colors">
                        <span class="text-3xl">🎓</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white group-hover:text-white">Pendidikan Formal</h3>
                    <p class="text-gray-500 dark:text-zinc-400 group-hover:text-green-100 leading-relaxed">
                        Jenjang SMP & SMA Berbasis Pesantren dengan kurikulum nasional.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="relative py-20 bg-green-900 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Bergabung?</h2>
            <p class="text-emerald-100 text-lg mb-10 leading-relaxed">
                Mari wujudkan impian menjadi generasi Qur'ani yang unggul dan berprestasi bersama kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/pendaftaran" class="px-10 py-4 bg-white text-green-900 font-bold rounded-full hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Daftar Online Sekarang
                </a>
                <a href="/kontak" class="px-10 py-4 bg-transparent border-2 border-white/30 text-white font-bold rounded-full hover:bg-white/10 transition-colors">
                    Hubungi Admin
                </a>
            </div>
        </div>
    </div>
</x-layout>