@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'py-3 px-5 text-sm text-white border-b-2 border-b-transparent hover:border-b-2 hover:border-b-utama flex
items-center gap-2 bg-utama'
: 'py-3 px-5 text-sm text-gray-800 border-b-2 border-b-transparent hover:border-b-2 hover:border-b-utama flex
items-center gap-2 hover:bg-utama/20';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }} class="cursor-pointer">
        {{ $text }}
    </a>
</li>