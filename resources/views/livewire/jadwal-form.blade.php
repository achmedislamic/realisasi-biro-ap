<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pengaturan Jadwal Input Realisasi
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-row space-x-3 mb-3">
            <div class="w-full">
                <x-native-select wire:model="jadwal.nama_bulan" label="Bulan">
                    <option value="">Silakan Pilih</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </x-native-select>
            </div>
            <div class="w-full">
                <x-datetime-picker
                    label="Tanggal"
                    wire:model.defer="jadwal.tanggal_waktu"
                />
                @if (filled($jadwal->tanggal_waktu))
                    <p>Jadwal sebelumnya telah diatur. Silakan ubah tanggal dan waktu di atas jika diperlukan.</p>
                @endif
            </div>
        </div>
        <div class="flex justify-between">
            <x-button gray label="Kembali" href="{{ url()->previous() }}" />
            <x-button type="submit" positive label="Simpan" />
        </div>
    </form>

</x-container>
