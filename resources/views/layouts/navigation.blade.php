<nav class="px-4 py-2 md:py-4 xl:px-0">
    <div class="container md:mx-auto bg-white rounded-lg pt-1">
        <div class="flex flex-col lg:items-center">
            <div class="flex items-center justify-center">
                <x-navigation.logo />
            </div>
            <div class="w-full flex justify-between">
                <ul class="hidden lg:flex items-center space-x-4 text-sm font-semibold">
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
                <div class="hidden lg:flex ml-auto items-center">
                    <x-navigation.pengguna-link />
                </div>
            </div>
        </div>
    </div>
</nav>
