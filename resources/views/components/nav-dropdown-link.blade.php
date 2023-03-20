@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'px-2 xl:px-4 py-2 text-gray-800 border-b-4 border-b-utama hover:bg-utama/30 transition duration-150
ease-in-out flex gap-2 items-center'
: 'px-2 xl:px-4 py-2 text-gray-800 border-b-4 border-transparent hover:border-b-4 hover:border-b-utama
hover:bg-utama/30 transition duration-150
ease-in-out flex gap-2 items-center';
@endphp

<li class="relative" x-data="{ open: false }">
    <a {{ $attributes->merge(['class' => $classes]) }} x-on:click="open = !open" x-on:click.outside="open = false"
        href="#">
        {{ $text }}
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 stroke-current stroke-2 text-gray-800 transform duration-500 ease-in-out"
            :class="open ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <ul x-cloak x-show="open" x-transition
        class="absolute left-0 bg-white py-2 rounded-md shadow-lg overflow-hidden w-max z-50">
        {{ $slot }}
    </ul>
</li>