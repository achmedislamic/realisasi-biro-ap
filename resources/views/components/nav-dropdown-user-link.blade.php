@props(['text'])

<div class="relative" x-data="{ open: false }">
    <a x-on:click="open = !open" x-on:click.outside="open = false" href="#"
        class="px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-utama hover:text-white font-semibold">
        {{ $text }}
    </a>

    <ul x-cloak x-show="open" x-transition
        class="absolute left-0 bg-white py-2 rounded-md shadow-lg overflow-hidden w-max z-50 mt-4">
        {{ $slot }}
    </ul>
</div>
