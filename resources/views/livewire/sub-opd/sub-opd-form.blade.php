<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Sub OPD
    </h2>
</x-slot>

<x-container>
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        @if (filled($bidangUrusan))
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $bidangUrusan->urusan->kode ?? '' }} {{ $bidangUrusan->urusan->nama ?? '' }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-4 h-0.5"></div>
                <p>{{ $bidangUrusan->kode ?? '' }} {{ $bidangUrusan->nama ?? '' }}</p>
            </div>
        @endif

        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>{{ $opd->kode ?? '' }} {{ $opd->nama ?? '' }}</p>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Sub OPD" wire:model.defer="subOpd.kode" placeholder="Nama Sub OPD" />
            <x-input label="Nama Sub OPD" wire:model.defer="subOpd.nama" placeholder="Nama Sub OPD" />
            <x-input label="Nama Kepala UPT/Biro" wire:model.defer="subOpd.nama_kepala" />
            <x-input label="NIP" wire:model.defer="subOpd.nip_kepala" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>
