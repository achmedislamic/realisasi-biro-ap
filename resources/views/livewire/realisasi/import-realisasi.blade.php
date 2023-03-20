<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Import Data Anggaran Realisasi
    </h2>
</x-slot>

<x-container-no-overflow>
    @livewire('realisasi.import-realiasi-progress')

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
                @if (!$hideButton)
                <x-button type="submit" positive label="Import" />
                @endif
            </div>
        </div>
    </form>
</x-container-no-overflow>