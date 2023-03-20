<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Realisasi
    </h2>
</x-slot>

<x-container>

    <div>
        @if (session()->has('message'))
        <div class="bg-green-300 p-4 rounded-md border-2 border-green-600 mb-4 text-gray-900 w-full">
            <div class="flex justify-between">
                <h4 class="font-semibold">{{ session('message') }}</h4>
                <x-button.circle negative xs icon="x" wire:click="flushSession" />
            </div>

        </div>
        @endif
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            {{--
            <x-input label="Nama Sub OPD" wire:model.defer="subOpd.nama" placeholder="Nama Sub OPD" /> --}}

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-datetime-picker label="Tanggal Realisasi" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD"
                        display-format="DD-MM-YYYY" wire:model.defer="tanggal" without-time
                        display-format="DD-MM-YYYY" />
                </div>

                <div class="w-full">
                    <x-native-select label="Tahapan APBD" wire:model.defer="idTahapanApbd">
                        <option selected>Pilih tahapan APBD</option>
                        @foreach ($tahapanApbds as $tahapan)
                        <option value="{{ $tahapan->id }}">{{ $tahapan->tahun }} - {{ $tahapan->nama}}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <hr>

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

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-inputs.number label="Anggaran" prefix="Rp." wire:model.defer="anggaran" />
                </div>

                <div class="w-full">
                    <x-inputs.number label="Realisasi" wire:model.defer="realisasi" />
                </div>
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container>