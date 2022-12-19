@props(['text'])

<ul class="flex items-center gap-6">
    <li class="relative" x-data="{ open: false }">
        <a x-on:click="open = !open" x-on:click.outside="open = false" href="#"
            class="px-2 xl:px-4 py-1 text-white border border-white hover:bg-blue-700 font-bold flex gap-2 items-center">
            {{ $text }}
        </a>

        <ul x-cloak x-show="open" x-transition
            class="absolute top-10 left-0 bg-white py-2 shadow overflow-hidden w-max">
            {{ $slot }}
        </ul>
    </li>
</ul>
