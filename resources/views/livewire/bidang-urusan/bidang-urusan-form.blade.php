<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Bidang Urusan
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">{{ $urusan->kode }} {{ $urusan->nama }}</h4>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Bidang Urusan" wire:model.defer="bidangUrusan.kode" placeholder="Kode bidang urusan" />
            <x-input label="Nama Bidang Urusan" wire:model.defer="bidangUrusan.nama" placeholder="Nama bidang urusan" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>