<x-nav-dropdown-link text="Realisasi" :active="request()->segment(1) == 'realisasi'">
    <x-nav-dropdown-item-link text="Realisasi" :href="route('realisasi')" :active="request()->routeIs('realisasi')" />
    <x-nav-dropdown-item-link text="Input Realisasi" :href="route('realisasi.form')"
        :active="request()->routeIs('realisasi.form')" />

    @if (Auth::user()->role->role_name === 'admin')
    <x-nav-dropdown-item-link text="Import Realisasi" :href="route('realisasi.import')"
        :active="request()->routeIs('realisasi.import')" />
    @endif
</x-nav-dropdown-link>
