<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Akun Belanja
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode" wire:model.defer="akunBelanja.kode" placeholder="Kode akun" />
            <x-input label="Nama" wire:model.defer="akunBelanja.nama" placeholder="Nama akun" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>