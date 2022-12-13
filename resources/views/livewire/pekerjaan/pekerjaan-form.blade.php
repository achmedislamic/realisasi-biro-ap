<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Pekerjaan
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Nama Pekrjaan" wire:model.lazy="pekerjaan.nama" placeholder="Masukkan nama pekerjaan" />
            <x-inputs.number label="Volume" wire:model.lazy="pekerjaan.volume" placeholder="Volume" />
            <x-input label="Satuan" wire:model.lazy="pekerjaan.satuan" placeholder="Satuan" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
