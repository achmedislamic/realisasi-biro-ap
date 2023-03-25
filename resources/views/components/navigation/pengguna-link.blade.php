<x-nav-dropdown-user-link text="{{ auth()->user()->name }}">
    <x-nav-dropdown-item-link text="Pengguna" :href="route('pengguna')" :active="request()->routeIs('pengguna')" />

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="py-3 px-5 text-sm text-gray-800 flex items-center gap-2 hover:bg-red-500 hover:text-white w-full">
            Keluar
        </button>
    </form>

</x-nav-dropdown-user-link>
