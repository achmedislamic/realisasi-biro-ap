<x-nav-dropdown-link text="Realisasi" :active="request()->segment(1) == 'realisasi'">
    <x-nav-dropdown-item-link text="Realisasi" :href="route('realisasi')" :active="request()->routeIs('realisasi')" />
    <x-nav-dropdown-item-link text="Input Objek Realisasi" :href="route('objek-realisasi.form')"
        :active="request()->routeIs('objek-realisasi.form')" />

    @if (Auth::user()->role->role_name === 'admin')
    <x-nav-dropdown-item-link text="Import Objek Realisasi" :href="route('objek-realisasi.import')"
        :active="request()->routeIs('objek-realisasi.import')" />
    @endif
</x-nav-dropdown-link>
