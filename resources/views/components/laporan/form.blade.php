@props(['jenisLaporan' => 'a', 'bulans', 'urusans', 'bidangUrusans', 'opds', 'subOpds'])
<form wire:submit.prevent="cetak">
    <div class="flex flex-col space-y-3">
        <div class="flex items-end gap-x-4">
            <div class="w-full">
                @if (auth()->user()->isSubOpd())
                    <p>Sub Unit: {{ auth()->user()->role->imageable->teks_lengkap }}</p>
                @else
                    <x-native-select label="Sub OPD" wire:model.defer="subOpdDipilih">
                        <option value="">Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                            <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                        @endforeach
                    </x-native-select>
                @endif
            </div>

            @if ($jenisLaporan == 'e')
                <div class="w-full">
                    <x-periode-rincian-masalah />
                </div>
            @endif
        </div>
        <div class="flex gap-4">
            @if ($jenisLaporan != 'e')
                <div class="w-full">
                    <x-native-select label="Urusan" wire:model="urusanDipilih">
                        <option value="">Pilih urusan</option>
                        @foreach ($urusans as $urusan)
                            <option value="{{ $urusan->id }}">{{ $urusan->kode }} - {{ $urusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div class="w-full">
                    <x-native-select label="Bidang Urusan" wire:model.defer="bidangUrusanDipilih">
                        <option value="">Pilih Bidang Urusan</option>
                        @foreach ($bidangUrusans as $bidangUrusan)
                            <option value="{{ $bidangUrusan->id }}">{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            @endif

            <div class="w-3/4">
                @if ($jenisLaporan == 'a')
                    <x-native-select label="Bulan" wire:model.defer="bulan">
                        <option value="">Pilih bulan</option>
                        @foreach ($bulans as $bulan => $value)
                            <option value="{{ $value }}">{{ $bulan }}</option>
                        @endforeach
                    </x-native-select>
                @elseif($jenisLaporan == 'semester')
                    <x-native-select label="Semester" wire:model.defer="semester">
                        <option value="">Pilih Semester</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-01-01' }}">Semester 1</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-07-01' }}">Semester 2</option>
                    </x-native-select>
                @elseif($jenisLaporan == 'b' || $jenisLaporan == 'c')
                    <x-native-select label="Triwulan" wire:model.defer="triwulan">
                        <option value="">Pilih Triwulan</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-01-01' }}">Triwulan 1</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-04-01' }}">Triwulan 2</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-07-01' }}">Triwulan 3</option>
                        <option value="{{ cache('tahapanApbd')->tahun . '-10-01' }}">Triwulan 4</option>
                    </x-native-select>
                @endif

            </div>
        </div>

        <div class="flex">
            <div class="ml-auto">
                <x-button spinner positive label="Unduh" type="submit" />
            </div>
        </div>
    </div>
</form>
