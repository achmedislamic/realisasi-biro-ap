<x-nav-dropdown-link text="Realisasi" :active="request()->routeIs('realisasi')">
    <x-nav-dropdown-item-link text="Upload Excel" link="#" />
    <x-nav-dropdown-item-link text="Tes Upload Excel Program Kegiatan Subkegiatan" href="{{ route('upload-program-kegiatan-subkegiatan') }}" />
    <x-nav-dropdown-item-link text="Input Realisasi" link="#" />
    <x-nav-dropdown-item-link text="Pokir" link="#" />
</x-nav-dropdown-link>
