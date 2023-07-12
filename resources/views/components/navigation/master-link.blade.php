<x-nav-dropdown-link text="Master" :active="request()->segment(1) == 'master'">
    <x-nav-dropdown-item-link text="Urusan" :href="route('perangkat-daerah')"
        :active="request()->segment(2) == 'urusan-opd'" />
    <x-nav-dropdown-item-link text="Program Kegiatan" :href="route('program-kegiatan')"
        :active="request()->segment(2) == 'program-kegiatan'" />
    <x-nav-dropdown-item-link text="Rekening Belanja" :href="route('rekening')"
        :active="request()->segment(2) == 'rekening-belanja'" />
    <x-nav-dropdown-item-link text="Satuan" :href="route('satuan')"
        :active="request()->segment(2) == 'satuan'" />
</x-nav-dropdown-link>
