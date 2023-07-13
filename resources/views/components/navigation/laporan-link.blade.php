<x-nav-dropdown-link text="Laporan" :active="request()->routeIs('laporan')">
    <x-nav-dropdown-item-link text="Laporan Bulanan" :href="route('laporan-bulan')"
                              :active="request()->routeIs('laporan-bulan')" />
    <x-nav-dropdown-item-link text="Laporan Triwulanan" :href="route('laporan-triwulan')"
                              :active="request()->routeIs('laporan-triwulan')" />
    <x-nav-dropdown-item-link text="Laporan Semester" :href="route('laporan-semester')"
                              :active="request()->routeIs('laporan-semester')" />
    <x-nav-dropdown-item-link text="Laporan Tahunan" :href="route('laporan-tahun')"
                              :active="request()->routeIs('laporan-tahun')" />

</x-nav-dropdown-link>
