<div class="bg-emerald-500 shadow-sm rounded-lg border border-gray-100">
    <h2>Dashboard</h2>
    @if(auth()->user()->hasRole('super_admin'))
        <p>Welcome, Super Admin!</p>

    @elseif(auth()->user()->hasRole('admin_akademik'))
        <p>Welcome, Admin Akademik!</p>
    @elseif(auth()->user()->hasRole('guru'))
        <p>Welcome, Guru!</p>
    @endif
</div>
