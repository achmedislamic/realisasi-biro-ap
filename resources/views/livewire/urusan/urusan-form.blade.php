<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Urusan
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode" wire:model.defer="urusan.kode" placeholder="Kode urusan" />
            <x-input label="Nama" wire:model.defer="urusan.nama" placeholder="Nama urusan" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" :href="route('perangkat-daerah')" />
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>