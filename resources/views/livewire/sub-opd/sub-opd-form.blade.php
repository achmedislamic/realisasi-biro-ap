<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Sub OPD
    </h2>
</x-slot>

<x-container>
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $opd->bidangUrusans[0]->urusan->kode ?? "" }} {{ $opd->bidangUrusans[0]->urusan->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $opd->bidangUrusans[0]->kode ?? "" }} {{ $opd->bidangUrusans[0]->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>{{ $opd->kode ?? "" }} {{ $opd->nama ?? "" }}</p>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Sub OPD" wire:model.defer="subOpd.kode" placeholder="Nama Sub OPD" />
            <x-input label="Nama Sub OPD" wire:model.defer="subOpd.nama" placeholder="Nama Sub OPD" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>