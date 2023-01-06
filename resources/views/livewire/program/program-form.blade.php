<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Program
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-inputs.maskable label="Kode" mask="##.##.##" placeholder="Kode" wire:model.defer="program.kode"
                placeholder="Masukan program belanja" />
            <x-input label="Nama" wire:model.defer="program.nama" placeholder="Nama program belanja" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
