<x-nav-dropdown-link text="Laporan" :active="request()->routeIs('laporan')">
    <x-nav-dropdown-item-link text="Laporan Form A" :href="route('laporan-form-a')"
        :active="request()->routeIs('laporan-form-a')" />
    <x-nav-dropdown-item-link text="Laporan Form B" link="#" />
    <x-nav-dropdown-item-link text="Laporan Form C" link="#" />
    <x-nav-dropdown-item-link text="Laporan Form D" link="#" />
    <x-nav-dropdown-item-link text="Laporan Form E" link="#" />
    <x-nav-dropdown-item-link text="Laporan Deviasi" link="#" />
</x-nav-dropdown-link>