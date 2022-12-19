<x-nav-dropdown-user-link text="{{ auth()->user()->name }}" :active="request()->routeIs('profil')">
    <x-nav-dropdown-item-link text="Ubah Profil" />
    <x-nav-dropdown-item-link text="Ubah Password" />

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="p-4 text-sm text-gray-600 w-full rounded flex items-center gap-2 hover:bg-gray-100">Keluar</button>
    </form>

</x-nav-dropdown-user-link>
