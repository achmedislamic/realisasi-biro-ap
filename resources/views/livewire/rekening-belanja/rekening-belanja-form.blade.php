<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Rekening Belanja
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-inputs.maskable label="Kode" mask="##.##.##" placeholder="Kode" wire:model.defer="rekening.kode"
                placeholder="Masukan rekening belanja" />
            <x-input label="Nama" wire:model.defer="rekening.nama" placeholder="Nama rekening belanja" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
