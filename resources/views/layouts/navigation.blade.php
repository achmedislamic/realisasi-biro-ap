<nav class="p-4 md:py-8 xl:px-0 md:container md:mx-w-6xl md:mx-auto">
    <div class="hidden lg:flex lg:justify-between lg:items-center">
        <x-navigation.logo />
        <ul class="flex items-center space-x-4 text-sm font-semibold">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Beranda</x-nav-link>
            <x-navigation.master-link />
            <x-navigation.realisasi-link />
            <x-navigation.laporan-link />

        </ul>

        <x-navigation.pengguna-link />

    </div>
</nav>
<!-- End Nav -->
