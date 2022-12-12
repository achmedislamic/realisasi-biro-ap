<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Tahapan APBD
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Nama Tahapan" wire:model.lazy="tahapan.nama_tahapan" placeholder="Masukkan nama tahapan" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
