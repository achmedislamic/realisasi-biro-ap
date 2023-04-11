<x-slot:header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Laporan Form A
    </h2>
</x-slot:header>

<x-container>
    <form wire:submit.prevent="cetak">
        <div class="flex flex-col space-y-3">
            <div class="flex gap-4">
                <div class="w-full">
                    <x-native-select label="Urusan" wire:model="urusanDipilih">
                        <option value="">Pilih urusan</option>
                        @foreach ($urusans as $urusan)
                        <option value="{{ $urusan->id }}">{{ $urusan->kode }} - {{ $urusan->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="w-full">
                    <x-native-select label="Bidang Urusan" wire:model.defer="bidangUrusanDipilih">
                        <option value="">Pilih Bidang Urusan</option>
                        @foreach ($bidangUrusans as $bidangUrusan)
                        <option value="{{ $bidangUrusan->id }}">{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="w-3/4">
                    <x-native-select label="Bulan" wire:model.defer="bulan">
                        <option value="">Pilih bulan</option>
                        <option value="{{ 1 }}">Januari</option>
                        <option value="{{ 2 }}">Februari</option>
                        <option value="{{ 3 }}">Maret</option>
                        <option value="{{ 4 }}">April</option>
                        <option value="{{ 5 }}">Mei</option>
                        <option value="{{ 6 }}">Juni</option>
                        <option value="{{ 7 }}">Juli</option>
                        <option value="{{ 8 }}">Agustus</option>
                        <option value="{{ 9 }}">September</option>
                        <option value="{{ 10 }}">Oktober</option>
                        <option value="{{ 11 }}">November</option>
                        <option value="{{ 12 }}">Desember</option>
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select label="OPD" wire:model="opdDipilih">
                        <option value="">Pilih OPD</option>
                        @foreach ($pods as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select label="Sub OPD" wire:model.defer="subOpdDipilih">
                        <option value="">Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                        <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex">
                <div class="ml-auto">
                    <x-button positive label="Cetak" type="submit" />
                </div>
            </div>
        </div>
    </form>
</x-container>
