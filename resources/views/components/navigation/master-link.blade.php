<x-nav-dropdown-link text="Master" :active="request()->routeIs('master')">
    <x-nav-dropdown-item-link text="Perangkat Daerah" :href="route('perangkat-daerah')" />
    <x-nav-dropdown-item-link text="Program Kegiatan" :href="route('program-kegiatan')" />
    <x-nav-dropdown-item-link text="Rekening Belanja" :href="route('rekening')" />
</x-nav-dropdown-link>