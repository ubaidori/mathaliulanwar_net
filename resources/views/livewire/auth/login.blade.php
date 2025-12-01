<div>
    <form wire:submit="authenticate" class="space-y-5">
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input wire:model="email" type="email" id="email" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring focus:ring-pesantren-primary focus:ring-opacity-50 py-2 px-3 border" 
                   placeholder="admin@mathaliul.com">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input wire:model="password" type="password" id="password" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pesantren-primary focus:ring focus:ring-pesantren-primary focus:ring-opacity-50 py-2 px-3 border" 
                   placeholder="••••••••">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                <span wire:loading.remove>Masuk</span>
                <span wire:loading>Memproses...</span>
            </button>
        </div>
    </form>
</div>