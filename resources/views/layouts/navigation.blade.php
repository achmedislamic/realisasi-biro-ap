<nav class="bg-white px-4 py-4 md:py-6 xl:px-0 shadow-md">
    <div class="container md:mx-auto">
        <div class="flex justify-between lg:justify-between lg:items-center">
            <x-navigation.logo />
            <ul class="hidden lg:flex items-center space-x-4 text-sm font-semibold">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Beranda
                </x-nav-link>
                <x-nav-link :href="route('tahapan-apbd')" :active="request()->routeIs('tahapan-apbd')">Tahapan APBD
                </x-nav-link>
                <x-navigation.master-link />
                <x-navigation.realisasi-link />
            </ul>

            <div class="hidden lg:flex">
                <x-navigation.pengguna-link />
            </div>

        </div>
    </div>
</nav>