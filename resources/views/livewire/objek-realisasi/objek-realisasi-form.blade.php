<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Objek Realisasi
    </h2>
</x-slot>

<x-container>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select label="OPD" wire:model="opdPilihan">
                        <option selected>Pilih OPD</option>
                        @foreach ($pods as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select label="Sub OPD" wire:model.defer="subOpdPilihan">
                        <option selected>Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                        <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select label="Program" wire:model="programPilihan">
                        <option selected>Pilih Program</option>
                        @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->kode }} - {{ $program->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select label="Kegiatan" wire:model="kegiatanPilihan">
                        <option selected>Pilih Kegiatan</option>
                        @foreach ($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->kode }} - {{ $kegiatan->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <x-native-select label="Sub Kegiatan" wire:model.defer="subKegiatanPilihan">
                <option selected>Pilih Sub Kegiatan</option>
                @foreach ($subKegiatans as $subKegiatan)
                <option value="{{ $subKegiatan->id }}">{{ $subKegiatan->kode }} - {{ $subKegiatan->nama}}</option>
                @endforeach
            </x-native-select>

            <x-native-select label="Rekening Belanja" wire:model.defer="rekeningBelanjaPilihan">
                <option selected>Pilih Rekenig Belanja (Sub Rincian Objek)</option>
                @foreach ($subRincianObjekBelanjas as $rekening)
                <option value="{{ $rekening->id }}">{{ $rekening->kode }} - {{ $rekening->nama}}</option>
                @endforeach
            </x-native-select>

            <div class="w-full">
                <x-inputs.number label="Anggaran" prefix="Rp." wire:model.defer="anggaran" />
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container>
