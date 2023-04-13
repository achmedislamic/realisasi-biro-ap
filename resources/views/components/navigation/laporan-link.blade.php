<x-nav-dropdown-link text="Laporan" :active="request()->routeIs('laporan')">
    <x-nav-dropdown-item-link text="Laporan Form A" :href="route('laporan-form-a')"
                              :active="request()->routeIs('laporan-form-a')" />
    <x-nav-dropdown-item-link text="Laporan Form B" :href="route('laporan-form-b')"
                              :active="request()->routeIs('laporan-form-b')" />
    <x-nav-dropdown-item-link text="Laporan Form C" link="#" />
    <x-nav-dropdown-item-link text="Laporan Form D" link="#" />
    <x-nav-dropdown-item-link text="Laporan Form E" link="#" />
    <x-nav-dropdown-item-link text="Laporan Deviasi" :href="route('laporan-deviasi')"
                              :active="request()->routeIs('laporan-deviasi')" />
</x-nav-dropdown-link>
