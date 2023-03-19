<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Sub Kegiatan
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">
                {{ $kegiatan->program->kode ?? "" }} {{ $kegiatan->program->nama ?? ""}}
            </h4>
            <div class="border-l-8 border-l-orange-500">
                <h4 class="font-semibold pl-2">
                    {{ $kegiatan->kode ?? "" }} {{ $kegiatan->nama ?? "" }}
                </h4>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Sub Kegiatan" wire:model.defer="subKegiatan.kode" placeholder="Kode Sub Kegiatan" />
            <x-input label="Nama Sub Kegiatan" wire:model.defer="subKegiatan.nama" placeholder="Nama Sub Kegiatan" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>