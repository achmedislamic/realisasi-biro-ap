<x-nav-dropdown-user-link text="{{ auth()->user()->name }}">
    @if (auth()->user()->isAdmin() || auth()->user()->isOpd())
        <x-nav-dropdown-item-link text="Pengguna" :href="route('pengguna')" :active="request()->routeIs('pengguna')" />
    @endif
    @if (auth()->user()->isAdmin())
        <x-nav-dropdown-item-link text="Pengaturan Jadwal" :href="route('jadwal.form')" :active="request()->routeIs('jadwal')" />
        <x-nav-dropdown-item-link text="Pengaturan Target Tiap OPD" :href="route('target')" :active="request()->routeIs('target')" />
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="py-3 px-5 text-sm text-gray-800 flex items-center gap-2 hover:bg-red-500 hover:text-white w-full">
            Keluar
        </button>
    </form>

</x-nav-dropdown-user-link>
