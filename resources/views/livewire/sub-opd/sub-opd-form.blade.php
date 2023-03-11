<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form OPD
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">
                {{ $opd->bidangUrusans[0]->urusan->kode ?? "" }} {{ $opd->bidangUrusans[0]->urusan->nama ?? "" }}
            </h4>
            <div class="border-l-8 border-l-orange-500">
                <h4 class="font-semibold pl-2">
                    {{ $opd->bidangUrusans[0]->kode ?? "" }} {{ $opd->bidangUrusans[0]->nama ?? "" }}
                </h4>
                <div class="border-l-8 border-l-green-600">
                    <h4 class="font-semibold pl-2">{{ $opd->kode ?? "" }} {{ $opd->nama ?? "" }}</h4>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Sub OPD" wire:model.defer="subOpd.kode" placeholder="Nama Sub OPD" />
            <x-input label="Nama Sub OPD" wire:model.defer="subOpd.nama" placeholder="Nama Sub OPD" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>