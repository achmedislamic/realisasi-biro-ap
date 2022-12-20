<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Anggora DPRD
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-native-select label="Periode" placeholder="Periode"
                :options="[2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035]"
                wire:model.defer="anggotaDprd.awal_periode" />
            <x-input label="Fraksi" wire:model.defer="anggotaDprd.fraksi" placeholder="Fraksi" />
            <x-input label="Nama" wire:model.defer="anggotaDprd.nama" placeholder="Nama Anggota DPRD" />
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
