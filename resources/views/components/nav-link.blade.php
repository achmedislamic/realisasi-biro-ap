@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-2 xl:px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200'
            : 'px-2 xl:px-4 py-2 text-gray-800 rounded-md bg-gray-200';
@endphp

<li><a {{ $attributes->merge(['class' => $classes]) }}>{{
$slot }}</a></li>
