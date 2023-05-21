<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Data Anggaran
    </h2>
</x-slot>

<x-container>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Urusan" wire:model="urusanPilihan">
                        <option selected>Pilih Urusan</option>
                        @foreach ($urusans as $urusan)
                            <option value="{{ $urusan->id }}">{{ $urusan->kode }} - {{ $urusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Bidang Urusan" wire:model.defer="bidangUrusanPilihan">
                        <option selected>Pilih Bidang Urusan</option>
                        @foreach ($bidangUrusans as $bidangUrusan)
                            <option value="{{ $bidangUrusan->id }}">{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="OPD" wire:model="opdPilihan">
                        <option selected>Pilih OPD</option>
                        @foreach ($pods as $opd)
                            <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Sub OPD" wire:model.defer="subOpdPilihan">
                        <option selected>Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                            <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Program" wire:model="programPilihan">
                        <option selected>Pilih Program</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->kode }} - {{ $program->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Kegiatan" wire:model="kegiatanPilihan">
                        <option selected>Pilih Kegiatan</option>
                        @foreach ($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}">{{ $kegiatan->kode }} - {{ $kegiatan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Sub Kegiatan" wire:model.defer="subKegiatanPilihan">
                <option selected>Pilih Sub Kegiatan</option>
                @foreach ($subKegiatans as $subKegiatan)
                    <option value="{{ $subKegiatan->id }}">{{ $subKegiatan->kode }} - {{ $subKegiatan->nama }}</option>
                @endforeach
            </x-native-select>

            <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Rekening Belanja" wire:model.defer="rekeningBelanjaPilihan">
                <option selected>Pilih Rekenig Belanja (Sub Rincian Objek)</option>
                @foreach ($subRincianObjekBelanjas as $rekening)
                    <option value="{{ $rekening->id }}">{{ $rekening->kode }} - {{ $rekening->nama }}</option>
                @endforeach
            </x-native-select>

            <div class="w-full">
                <x-inputs.currency
                :disabled="auth()->user()->isNotAdmin()"
                                   label="Anggaran"
                                   thousands="."
                                   decimal=","
                                   precision="4"
                                   wire:model.lazy="anggaran" />
            </div>

            <div class="flex flex-row space-x-3">
                <div class="w-full">
                    <x-inputs.currency
                                       label="Target Fisik"
                                       thousands="."
                                       decimal=","
                                       precision="4"
                                       wire:model.lazy="target" />
                </div>

                <div class="w-full">
                    <x-native-select label="Satuan" wire:model.defer="satuanId">
                        <option value="">Silakan Pilih</option>
                        @foreach (App\Models\Satuan::all() as $satuan)
                            <option value="{{ $satuan->id }}">{{ str($satuan->nama)->title() }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button spinner type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container>
