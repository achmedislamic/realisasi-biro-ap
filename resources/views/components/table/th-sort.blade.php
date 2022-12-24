@props(['sortBy', 'sortField', 'sortAsc'])

<x-table.th>
  <button wire:click="sortBy('{{ $sortBy }}')" class="font-bold underline">
      <div class="text-black dark:text-white font-bold">{{ $slot }}</div>
      @if ($sortField !== $sortBy)
      <span></span>
      @elseif($sortAsc)
      <x-icon name="arrow-up" class="w-5 h-5" />
      @else
      <x-icon name="arrow-down" class="w-5 h-5" />
      @endif

  </button>
</x-table.th>
