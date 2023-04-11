<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Cetak Laporan Deviasi
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="cetak">
        <div class="flex flex-row space-x-3">
            <div class="w-full">
                <x-native-select label="Pilih Bulan" wire:model.defer="bulan">
                    <option value="">Silakan Pilih</option>
                    @foreach ($months as $month => $value)
                        <option value="{{ $value }}">{{ $month }}</option>
                    @endforeach
                </x-native-select>
            </div>
            <x-button positive label="Cetak" type="submit" />
        </div>
    </form>
</x-container>
