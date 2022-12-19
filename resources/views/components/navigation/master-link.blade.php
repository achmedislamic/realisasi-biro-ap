<x-nav-dropdown-link text="Master" :active="request()->routeIs('master')">
    <x-nav-dropdown-item-link text="Tahapan" :href="route('tahapan-apbd')" />
    <x-nav-dropdown-item-link text="Rekening Belanja" />
    <x-nav-dropdown-item-link text="Satuan Belanja" />
    <x-nav-dropdown-item-link text="Program" />
    <x-nav-dropdown-item-link text="Kegiatan" />
    <x-nav-dropdown-item-link text="Sub Kegiatan" />
    <x-nav-dropdown-item-link text="Kategori" />
    <x-nav-dropdown-item-link text="Anggota DPRD" />
</x-nav-dropdown-link>
