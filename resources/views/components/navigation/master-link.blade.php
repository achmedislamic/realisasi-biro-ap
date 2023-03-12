<x-nav-dropdown-link text="Master" :active="request()->routeIs('master')">
    <x-nav-dropdown-item-link text="Tahapan" :href="route('tahapan-apbd')" />
    <x-nav-dropdown-item-link text="Perangkat Daerah" :href="route('perangkat-daerah')" />
    <x-nav-dropdown-item-link text="Program Kegiatan" :href="route('program-kegiatan')" />
    <x-nav-dropdown-item-link text="Rekening Belanja" :href="route('rekening')" />
    {{--
    <x-nav-dropdown-item-link text="Satuan Belanja" :href="route('satuan')" />
    <x-nav-dropdown-item-link text="Program" :href="route('program')" />
    <x-nav-dropdown-item-link text="Kegiatan" />
    <x-nav-dropdown-item-link text="Sub Kegiatan" />
    <x-nav-dropdown-item-link text="Kategori" />
    <x-nav-dropdown-item-link text="Anggota DPRD" :href="route('anggota-dprd')" /> --}}
</x-nav-dropdown-link>