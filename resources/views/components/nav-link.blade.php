@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'px-2 xl:px-4 py-2 text-gray-800 border-b-4 border-b-utama hover:bg-utama/30 transition duration-150
ease-in-out'
: 'px-2 xl:px-4 py-2 text-gray-800 hover:border-b-4 hover:border-b-utama hover:bg-utama/30 transition duration-150
ease-in-out';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $text }}
    </a>
</li>
