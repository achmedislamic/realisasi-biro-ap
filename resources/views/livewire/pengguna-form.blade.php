<x-slot:header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Pengguna
    </h2>
</x-slot:header>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                <div class="w-full">
                    <x-input type="email" label="Nama" wire:model.lazy="user.name" placeholder="Masukkan nama Anda" />
                </div>
                <div class="w-full">
                    <x-input wire:model.lazy="user.email" label="Email" placeholder="Masukkan email Anda" />
                </div>
            </div>

            @if (filled($user))
                <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                    <div class="w-full">
                        <x-inputs.password wire:model.lazy="password" label="Password" />
                    </div>
                    <div class="w-full">
                        <x-inputs.password wire:model.lazy="password_confirmation" label="Konfirmasi Password" />
                    </div>
                </div>
            @endif
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
