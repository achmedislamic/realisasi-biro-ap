<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Tahapan APBD
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-native-select label="Tahun" placeholder="Pilih tahun tahapan"
                :options="[2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035]"
                wire:model.defer="tahapan.tahun" />
            <x-input label="Nama Tahapan" wire:model.defer="tahapan.nama" placeholder="Masukkan nama tahapan" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
