<div class="flex flex-col overflow-clip">

    <div class="bg-utama text-white p-4">
        <h3 class="tracking-wide font-semibold">Pilih Tahapan APBD</h3>
    </div>

    <div class="flex flex-col gap-4 p-4">
        <x-native-select label="Tahun Anggaran" wire:model="tahunTahapanPilihan">
            @foreach ($tahunTahapans as $tahuntahapan)
            <option value="{{ $tahuntahapan->tahun }}">{{ $tahuntahapan->tahun }}</option>
            @endforeach
        </x-native-select>

        <x-native-select label="Tahapan" wire:model.defer="idTahapanPilihan">
            <option selected value="">Pilih Jenis Tahapan</option>
            @foreach ($namaTahapans as $namaTahapan)
            <option value="{{ $namaTahapan->id }}">{{ $namaTahapan->nama }}</option>
            @endforeach
        </x-native-select>

        <div class="flex justify-between">
            <x-button negative sm label="Batal" wire:click="$emit('closeModal')" />
            <x-button primary sm label="Masuk Tahapan" wire:click="gantiTahapanApbd" />
        </div>
    </div>
</div>