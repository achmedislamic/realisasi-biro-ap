<x-nav-dropdown-link text="Master" :active="
    request()->routeIs('perangkat-daerah') || request()->routeIs('program-kegiatan') || request()->routeIs('rekening')
">
    <x-nav-dropdown-item-link text="Perangkat Daerah" :href="route('perangkat-daerah')"
        :active="request()->routeIs('perangkat-daerah')" />
    <x-nav-dropdown-item-link text="Program Kegiatan" :href="route('program-kegiatan')"
        :active="request()->routeIs('program-kegiatan')" />
    <x-nav-dropdown-item-link text="Rekening Belanja" :href="route('rekening')"
        :active="request()->routeIs('rekening')" />
</x-nav-dropdown-link>