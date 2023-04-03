<div>
    <div class="flex gap-4">
        <div class="w-2/3">
            <x-native-select label="Urusan" wire:model.defer="idUrusanPilihan">
                <option selected>Pilih urusan</option>
                @foreach ($urusans as $urusan)
                <option value="{{ $urusan->id }}">{{ $urusan->kode }} - {{ $urusan->nama}}</option>
                @endforeach
            </x-native-select>
        </div>
        <div class="w-1/3">
            <x-native-select label="Bulan" wire:model.defer="bulan">
                <option selected>Pilih bulan</option>
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
            <x-native-select label="OPD" wire:model="idOpdPilihan">
                <option selected>Pilih OPD</option>
                @foreach ($pods as $opd)
                <option value="{{ $opd->id }}">{{ $opd->kode }} - {{ $opd->nama}}</option>
                @endforeach
            </x-native-select>
        </div>

        <div class="w-full">
            <x-native-select label="Sub OPD" wire:model.defer="idSubOpdPilihan">
                <option selected>Pilih Sub OPD (Unit)</option>
                @foreach ($subOpds as $subOpd)
                <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama}}</option>
                @endforeach
            </x-native-select>
        </div>
    </div>
</div>