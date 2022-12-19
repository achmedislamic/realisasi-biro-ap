@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'p-4 text-sm text-gray-600 rounded flex items-center gap-2 bg-gray-100'
: 'p-4 text-sm text-gray-600 rounded flex items-center gap-2 hover:bg-gray-100';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }} >
        {{ $text }}
    </a>
</li>
