@props(['text'])

<ul class="flex items-center gap-6">
    <li class="relative" x-data="{ open: false }">
        <a x-on:click="open = !open" x-on:click.outside="open = false" href="#"
            class="px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200 flex gap-2 items-center font-semibold">
            {{ $text }}
        </a>

        <ul x-cloak x-show="open" x-transition
            class="absolute top-10 left-0 bg-white p-4 rounded-md shadow overflow-hidden w-max">
            {{ $slot }}
        </ul>
    </li>
</ul>
