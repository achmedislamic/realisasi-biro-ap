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
                    <x-input label="Nama" wire:model.defer="user.name" placeholder="Masukkan nama Anda" />
                </div>
                <div class="w-full">
                    <x-input type="email" wire:model.defer="user.email" label="Email"
                             placeholder="Masukkan email Anda" />
                </div>
                @if (auth()->user()->isAdmin())
                    <div class="w-full">
                        <x-native-select label="Jenis Pengguna" wire:model="rolePengguna">
                            @foreach (\App\Enums\RoleName::cases() as $roleName)
                                <option value="{{ $roleName->value }}">{{ str($roleName->value)->title() }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                @endif

            </div>

            @if ($rolePengguna == \App\Enums\RoleName::SEKTOR)
                <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                    <div class="w-full">
                        @if (auth()->user()->isAdmin())
                            <x-native-select label="Sektor" wire:model="sektorPilihan">
                                <option selected>Pilih Sektor</option>
                                @foreach (\App\Models\Sektor::all() as $sektor)
                                    <option value="{{ $sektor->id }}">{{ $sektor->nama }}</option>
                                @endforeach
                            </x-native-select>
                        @endif

                    </div>
                </div>
            @endif

            @if ($rolePengguna == \App\Enums\RoleName::OPD || $rolePengguna == \App\Enums\RoleName::SUB_OPD)
                <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                    <div class="w-full">
                        @if (auth()->user()->isAdmin())
                            <x-native-select label="OPD" wire:model="opdPilihan">
                                <option selected>Pilih OPD</option>
                                @foreach ($pods as $opd)
                                    <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama }}</option>
                                @endforeach
                            </x-native-select>
                        @else
                            <p>Opd: {{ $opd->kode . ' ' . $opd->nama }}</p>
                        @endif

                    </div>
                </div>
            @endif

            @if (blank($userId) && ($rolePengguna == \App\Enums\RoleName::SUB_OPD || $rolePengguna == \App\Enums\RoleName::OPD))
                <div class="w-full">
                    <x-native-select label="Sub OPD" wire:model.defer="subOpdPilihan">
                        <option selected>Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                            <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endif

            @if (!is_null($userId))
                <div class="bg-red-500 text-white font-semibold tracking-wider p-4 rounded-md">
                    Kosongkan jika tidak ingin merubah password!
                </div>
            @endif

            @if (filled($user))
                <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                    <div class="w-full">
                        <x-inputs.password wire:model.defer="password" label="Password" />
                    </div>
                    <div class="w-full">
                        <x-inputs.password wire:model.defer="password_confirmation" label="Konfirmasi Password" />
                    </div>
                </div>
            @endif
            <div class="ml-auto">
                <x-button type="submit" positive label="{{ $buttonText }}" />
            </div>
        </div>
    </form>

</x-container>
