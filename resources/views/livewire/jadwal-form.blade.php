<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pengaturan Jadwal Input Realisasi
    </h2>
</x-slot>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-row space-x-3 mb-3">
            <div class="w-full">
                <x-native-select wire:model="jadwal.bulan" label="Bulan">
                    <option value="">Silakan Pilih</option>
                    <option value="{{ today()->setMonth(1)->startOfMonth() }}">Januari</option>
                    <option value="{{ today()->setMonth(2)->startOfMonth() }}">Februari</option>
                    <option value="{{ today()->setMonth(3)->startOfMonth() }}">Maret</option>
                    <option value="{{ today()->setMonth(4)->startOfMonth() }}">April</option>
                    <option value="{{ today()->setMonth(5)->startOfMonth() }}">Mei</option>
                    <option value="{{ today()->setMonth(6)->startOfMonth() }}">Juni</option>
                    <option value="{{ today()->setMonth(7)->startOfMonth() }}">Juli</option>
                    <option value="{{ today()->setMonth(8)->startOfMonth() }}">Agustus</option>
                    <option value="{{ today()->setMonth(9)->startOfMonth() }}">September</option>
                    <option value="{{ today()->setMonth(10)->startOfMonth() }}">Oktober</option>
                    <option value="{{ today()->setMonth(11)->startOfMonth() }}">November</option>
                    <option value="{{ today()->setMonth(12)->startOfMonth() }}">Desember</option>
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
            <x-button spinner type="submit" positive label="Simpan" />
        </div>
    </form>

</x-container>
