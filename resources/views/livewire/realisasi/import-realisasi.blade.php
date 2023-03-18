<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Upload Data Realisasi Pekerjaan
    </h2>
</x-slot>

<x-container-no-overflow>
    <div x-data="{ open: @entangle('sedangUpload') }">
        <ul x-show="open">
            <li><button wire:click="archive">Archive</button></li>
            <li><button wire:click="delete">Delete</button></li>
        </ul>
    </div>

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div class="flex flex-col space-y-3">
            <x-datetime-picker label="Tanggal Realisasi" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD"
                display-format="DD-MM-YYYY" wire:model.defer="tanggal" without-time display-format="DD-MM-YYYY" />

            <x-native-select label="Tahapan APBD" wire:model.defer="idTahapanApbd">
                <option selected>Pilih tahapan APBD</option>
                @foreach ($tahapanApbds as $tahapan)
                <option value="{{ $tahapan->id }}">{{ $tahapan->tahun }} - {{ $tahapan->nama}}</option>
                @endforeach
            </x-native-select>

            <x-input label="File Excel Realisasi" wire:model.defer="file" type="file" accept=".xls,.xlsx" />

            <div class="ml-auto">
                <x-button type="submit" positive label="Upload" />
            </div>
        </div>
    </form>
</x-container-no-overflow>