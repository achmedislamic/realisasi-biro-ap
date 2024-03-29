<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Upload Data Realisasi Pekerjaan
    </h2>
</x-slot>

<x-container>
    <div class="mb-8 border-b pb-4">
        <x-button green wire:click="downloadTemplate" label="Download Template Excel" />
    </div>

    <br>
    <div x-data="{ open: @entangle('uploadingStatus') }">
        <ul x-show="open" x-cloak>
            <li><button wire:click="archive">Archive</button></li>
            <li><button wire:click="delete">Delete</button></li>
        </ul>
    </div>
    <br>

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="flex flex-col space-y-3">

            <x-input label="File Excel Realisasi Pekerjaan" wire:model.defer="file" type="file"
                accept=".xls,.xlsx,.csv" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Upload" />
            </div>
        </div>
    </form>
</x-container>
