<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form OPD
    </h2>
</x-slot>

<x-container>
    @if ($idBidangUrusan != 0)
        <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $bidangUrusan->urusan->kode ?? "" }} {{ $bidangUrusan->urusan->nama ?? ""}}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-4 h-0.5"></div>
                <p>{{ $bidangUrusan->kode ?? "" }} {{ $bidangUrusan->nama ?? "" }}</p>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode OPD" wire:model.defer="opd.kode" placeholder="Kode OPD" />
            <x-input label="Nama OPD" wire:model.defer="opd.nama" placeholder="Nama OPD" />
            <x-native-select label="Sektor" wire:model.defer="opd.sektor">
                <option value="">Silakan Pilih</option>
                @foreach (\App\Enums\Sektor::cases() as $sektor)
                    <option value="{{ $sektor->value }}">{{ str($sektor->value)->headline() }}</option>
                @endforeach
            </x-native-select>
            <x-input label="Nama Kepala Perangkat Daerah" wire:model.defer="opd.nama_kepala" />
            <x-input label="NIP" wire:model.defer="opd.nip_kepala" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>
