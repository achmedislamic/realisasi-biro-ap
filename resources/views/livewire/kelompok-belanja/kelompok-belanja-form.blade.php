<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Kelompok Belanja
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">{{ $akunBelanja->kode }} {{ $akunBelanja->nama }}</h4>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Kelompok Belanja" wire:model.defer="kelompokBelanja.kode"
                placeholder="Kode Kelompok Belanja" />
            <x-input label="Nama Kelompok Belanja" wire:model.defer="kelompokBelanja.nama"
                placeholder="Nama Kelompok Belanja" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>