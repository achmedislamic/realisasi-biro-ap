@props(['disabled' => false, 'label' => null])

@php($name = $attributes->wire('model')->value())

<div class="@if ($disabled) opacity-60 @endif">
    @if ($label)
        <div class="flex justify-between items-end mb-1">
            <x-form.label for="{{ $name }}">
                {{ $label ?? '' }}
            </x-form.label>
        </div>

    @endif

    <div @if ($attributes->has('searchable')) wire:ignore @endif class="relative rounded-md shadow-sm">
        <select @if ($attributes->has('searchable')) x-data x-init="
                //fix focusable issue
                $el.removeAttribute('required');

                new Choices($el, {
                    allowHTML: false,
                    noResultsText: 'Tidak ada data ditemukan',
                    noChoicesText: 'Tidak ada pilihan untuk dipilih',
                });

                $el.addEventListener('change', function(event) {
                        $wire.set('{{ $name }}', event.detail.value);
                    }, false,
                );

                let options = $el.getElementsByTagName('option');

                for (let i = 0; i < options.length; i++) {
                    if(options[i].value === @this['{{ $name }}']){
                        options[i].selected = true;
                    }
                }

        " @endif id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
            {{ $slot }}
        </select>

        @error($name)
            <span class="text-red-500 mt-3">{{ $message }}</span>
        @enderror
    </div>

</div>
