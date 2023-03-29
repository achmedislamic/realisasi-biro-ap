<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Import Data Anggaran Objek Realisasi
    </h2>
</x-slot>

<x-container-no-overflow>
    @livewire('objek-realisasi.import-objek-realiasi-progress')

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="flex flex-col space-y-3">

            <x-input label="File Excel Anggaran Realisasi" wire:model.defer="file" type="file" accept=".xls,.xlsx" />

            <div class="ml-auto">
                @if (!$hideButton)
                <x-button type="submit" positive label="Import" />
                @endif
            </div>
        </div>
    </form>
</x-container-no-overflow>
