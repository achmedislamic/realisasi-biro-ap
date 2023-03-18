<x-nav-dropdown-link text="Realisasi" :active="request()->routeIs('realisasi')">
    <x-nav-dropdown-item-link text="Realisasi" :href="route('realisasi')" />
    <x-nav-dropdown-item-link text="Input Realisasi" link="#" />
    <x-nav-dropdown-item-link text="Import Realisasi" :href="route('realisasi.import')" />
</x-nav-dropdown-link>