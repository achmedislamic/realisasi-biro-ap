<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form OPD
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">
                {{ $bidangUrusan->urusan->kode ?? "" }} {{ $bidangUrusan->urusan->nama ?? ""}}
            </h4>
            <div class="border-l-8 border-l-orange-500">
                <h4 class="font-semibold pl-2">
                    {{ $bidangUrusan->kode ?? "" }} {{ $bidangUrusan->nama ?? "" }}
                </h4>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode OPD" wire:model.defer="opd.kode" placeholder="Kode OPD" />
            <x-input label="Nama OPD" wire:model.defer="opd.nama" placeholder="Nama OPD" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>