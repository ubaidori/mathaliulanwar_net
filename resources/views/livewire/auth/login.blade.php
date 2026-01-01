<div class="w-full max-w-sm mx-auto">
    
    <div class="mb-10">
        <h2 class="mt-6 text-2xl font-bold leading-9 tracking-tight text-zinc-900 dark:text-white">
            Masuk ke Dashboard
        </h2>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
            Silakan masukkan kredensial akun Anda.
        </p>
    </div>

    <form wire:submit="authenticate" class="space-y-6">
        
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-zinc-900 dark:text-zinc-200">
                Alamat Email
            </label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                        <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                    </svg>
                </div>
                <input wire:model="email" type="email" id="email" 
                       class="block w-full rounded-lg border-0 py-2.5 pl-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-900 dark:ring-zinc-700 dark:text-white dark:focus:ring-indigo-500" 
                       placeholder="admin@mathaliul.com">
            </div>
            @error('email') 
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ $message }}
                </p> 
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-zinc-900 dark:text-zinc-200">
                    Kata Sandi
                </label>
                <div class="text-sm">
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                        Lupa password?
                    </a>
                </div>
            </div>
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model="password" type="password" id="password" 
                       class="block w-full rounded-lg border-0 py-2.5 pl-10 text-zinc-900 ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-900 dark:ring-zinc-700 dark:text-white dark:focus:ring-indigo-500" 
                       placeholder="••••••••">
            </div>
            @error('password') 
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ $message }}
                </p> 
            @enderror
        </div>
        
        <div class="flex items-center">
            <input wire:model="remember" id="remember-me" type="checkbox" 
                   class="h-4 w-4 rounded border-zinc-300 text-indigo-600 focus:ring-indigo-600 dark:bg-zinc-900 dark:border-zinc-700">
            <label for="remember-me" class="ml-2 block text-sm text-zinc-900 dark:text-zinc-300">
                Ingat saya di perangkat ini
            </label>
        </div>

        <div>
            <button type="submit" 
                    class="flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                
                <span wire:loading.remove>Masuk</span>
                
                <div wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memproses...</span>
                </div>
            </button>
        </div>
    </form>
</div>