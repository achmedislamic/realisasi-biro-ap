<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Satuan
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Nama" wire:model.defer="satuan.nama" placeholder="Masukkan nama Satuan" />
            <x-input label="Satuan" wire:model.defer="satuan.satuan" placeholder="Satuan" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
