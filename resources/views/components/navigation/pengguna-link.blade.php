<x-nav-dropdown-user-link text="{{ auth()->user()->name }}" :active="request()->routeIs('profil')">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="py-3 px-5 text-sm text-gray-800 hover:bg-red-500 hover:text-white text-left w-full">
            Keluar
        </button>
    </form>

</x-nav-dropdown-user-link>