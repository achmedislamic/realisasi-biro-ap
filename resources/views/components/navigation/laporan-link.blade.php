<x-nav-dropdown-link text="Laporan" :active="request()->routeIs('laporan')">
    <x-nav-dropdown-item-link text="Laporan Bulanan (Form A)" :href="route('laporan-form-a')"
                              :active="request()->routeIs('laporan-form-a')" />
    <x-nav-dropdown-item-link text="Laporan Triwulanan (Form B)" :href="route('laporan-form-b')"
                              :active="request()->routeIs('laporan-form-b')" />
    <x-nav-dropdown-item-link text="Laporan Tahunan (Form C)" :href="route('laporan-form-c')"
                              :active="request()->routeIs('laporan-form-c')" />
    <x-nav-dropdown-item-link text="Laporan Rincian Masalah (Form E)" :href="route('laporan-form-e')"
                              :active="request()->routeIs('laporan-form-e')" />
    <x-nav-dropdown-item-link text="Laporan Deviasi" :href="route('laporan-deviasi')"
                              :active="request()->routeIs('laporan-deviasi')" />
</x-nav-dropdown-link>
