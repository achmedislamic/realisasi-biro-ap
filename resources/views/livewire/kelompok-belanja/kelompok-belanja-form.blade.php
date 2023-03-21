<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Kelompok Belanja
    </h2>
</x-slot>

<x-container>
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $akunBelanja->kode ?? "" }} {{ $akunBelanja->nama ?? "" }}</p>
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
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>