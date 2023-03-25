<x-nav-dropdown-link text="Realisasi" :active="request()->segment(1) == 'realisasi'">
    <x-nav-dropdown-item-link text="Realisasi" :href="route('realisasi')" :active="request()->routeIs('realisasi')" />
    <x-nav-dropdown-item-link text="Input Realisasi" :href="route('realisasi.form')"
        :active="request()->routeIs('realisasi.form')" />
    <x-nav-dropdown-item-link text="Import Realisasi" :href="route('realisasi.import')"
        :active="request()->routeIs('realisasi.import')" />
    <x-nav-dropdown-item-link text="Laporan" />
</x-nav-dropdown-link>
