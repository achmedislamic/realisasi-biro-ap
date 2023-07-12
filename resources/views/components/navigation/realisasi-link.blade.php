@if (auth()->user()->isBidangOrUpt())
    <x-nav-link :href="route('realisasi')" text="Input Realisasi" :active="request()->routeIs('realisasi')" />
@else
    <x-nav-dropdown-link text="Realisasi" :active="request()->segment(1) == 'realisasi'">
        <x-nav-dropdown-item-link text="Input Realisasi" :href="route('realisasi')" :active="request()->routeIs('realisasi')" />

        @can('is-admin')
            <x-nav-dropdown-item-link text="Input Objek Realisasi" :href="route('objek-realisasi.form')"
                                      :active="request()->routeIs('objek-realisasi.form')" />
            <x-nav-dropdown-item-link text="Import Objek Realisasi" :href="route('objek-realisasi.import')"
                                      :active="request()->routeIs('objek-realisasi.import')" />
        @endcan
    </x-nav-dropdown-link>
@endif
