<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Import Data Anggaran Objek Realisasi
    </h2>
</x-slot>

<x-container-no-overflow>
    @livewire('objek-realisasi.import-objek-realiasi-progress')

    <form wire:submit.prevent="upload">
        <div class="flex flex-col space-y-3">

            <x-input
                label="File Excel Anggaran Realisasi"
                wire:model.defer="file"
                type="file"
                accept=".xls,.xlsx" />

            <small><a href="{{ asset('dokumen/format-import.xlsx') }}" class="text-yellow-500 hover:underline hover:text-yellow-700">Format Excel-nya bisa diunduh di sini</a></small>

            <div class="ml-auto">
                @if (!$hideButton)
                <x-button spinner type="submit" positive label="Import" />
                @endif
            </div>
        </div>
    </form>
</x-container-no-overflow>
