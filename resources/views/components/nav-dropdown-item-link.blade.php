@props(['active', 'text'])

@php
$classes = ($active ?? false)
? 'px-2 xl:px-4 py-2 text-gray-800 rounded-md bg-gray-200'
: 'px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200';
@endphp

<li>
    <a href="#" class="p-4 text-sm text-gray-600 rounded flex items-center gap-2 hover:bg-gray-100">
        {{ $text }}
    </a>
</li>
