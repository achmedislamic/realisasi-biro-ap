<nav x-data="{ menu: false }" class="md:px-4 py-2 md:py-4 xl:px-0">
    <div class="container sm:mx-auto bg-white sm:rounded-lg pt-1">
        <div class="flex flex-col lg:items-center">
            <div class="flex items-center justify-between md:justify-center">
                <x-navigation.logo />

                <button @click="menu = ! menu" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"></path>
                    </svg>
                </button>
            </div>
            <div class="w-full flex justify-between">
                <ul class="md:flex items-center text-sm font-semibold">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" text="Beranda" />

                    @can('is-admin')
                    <x-nav-link href="/telescope" text="Monitoring Aplikasi" target="_blank" />
                    @endcan

                    @if (auth()->user()->isAdmin())
                    <x-nav-link :href="route('tahapan-apbd')"
                        :active="request()->routeIs('tahapan-apbd') || request()->routeIs('tahapan-apbd.form')"
                        text="Tahapan APBD" />
                    <x-navigation.master-link />
                    @endif

                    <x-navigation.realisasi-link />
                    <x-navigation.laporan-link />
                </ul>
                <div class="md:flex ml-auto items-center">
                    <x-navigation.pengguna-link />
                </div>
            </div>
        </div>
    </div>
</nav>
