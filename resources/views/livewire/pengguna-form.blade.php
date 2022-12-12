<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Pengguna
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Nama" wire:model.lazy="user.name" placeholder="Masukkan nama Anda" />
            <x-input wire:model.lazy="user.email" label="Email" placeholder="Masukkan email Anda" />
            @if (filled($user))
                <x-inputs.password wire:model.lazy="password" label="Password" />
                <x-inputs.password wire:model.lazy="password_confirmation" label="Konfirmasi Password" />
            @endif
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
