@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'px-2 xl:px-4 py-2 text-gray-800 rounded-md bg-gray-200'
: 'px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200';
@endphp

<li class="relative" x-data="{ open: false }">
    <a x-on:click="open = !open" x-on:click.outside="open = false" href="#"
        class="px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200 flex gap-2 items-center">
        {{ $text }}
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 stroke-current stroke-2 text-gray-800 transform duration-500 ease-in-out"
            :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <ul x-cloak x-show="open" x-transition
        class="absolute top-10 left-0 bg-white p-4 rounded-md shadow overflow-hidden w-max">
        {{ $slot }}
    </ul>
</li>
