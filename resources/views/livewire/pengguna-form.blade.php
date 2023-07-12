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
                    <x-input type="email" wire:model.lazy="user.email" label="Email"
                             placeholder="Masukkan email Anda" />
                </div>
                @if (blank($userId) && auth()->user()->isAdmin())
                    <div class="w-full">
                        <x-native-select label="Jenis Pengguna" wire:model="userRole.imageable_type">
                            @foreach (\App\Enums\RoleName::cases() as $roleName)
                                <option value="{{ $roleName->value }}">{{ str($roleName->value)->title() }}</option>
                            @endforeach
                        </x-native-select>
                    </div>
                @endif

            </div>

            @if (blank($userId) &&
                    auth()->user()->isAdmin() && in_array($userRole->imageable_type, [\App\Enums\RoleName::BIDANG->value, \App\Enums\RoleName::UPT->value]))
                <div class="flex flex-col space-y-3 md:flex-row md:space-x-3 md:space-y-0">
                    <div class="w-full">
                        <x-native-select :label="str($userRole->imageable_type)->title()" wire:model="userRole.imageable_id">
                            <option selected>Pilih {{ str($userRole->imageable_type)->title() }}</option>
                            @if ($userRole->imageable_type == \App\Enums\RoleName::BIDANG->value)
                                @foreach (\App\Models\Bidang::orderBy('nama')->get() as $bidang)
                                    <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                                @endforeach
                            @elseif ($userRole->imageable_type == \App\Enums\RoleName::UPT->value)
                                @foreach (\App\Models\Upt::orderBy('nama')->get() as $upt)
                                    <option value="{{ $upt->id }}">{{ $upt->nama }}</option>
                                @endforeach
                            @endif

                        </x-native-select>
                    </div>
                </div>
            @endif

            {{-- @if (blank($userId) &&
    (auth()->user()->isAdminOrSektor() ||
        auth()->user()->isOpd()) &&
    $user->imageable_type == \App\Enums\RoleName::SUB_OPD)
                <div class="w-full">
                    <x-native-select label="Sub OPD" wire:model.defer="subOpdPilihan">
                        <option selected>Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                            <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endif --}}

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
            @if (!is_null($userId))
                <div class="bg-red-500 text-white font-semibold tracking-wider p-4 rounded-md">
                    Kosongkan kolom password jika tidak ingin merubah password!
                </div>
            @endif
            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
