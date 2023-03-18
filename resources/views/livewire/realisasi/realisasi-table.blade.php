<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Realisasi Belanja
    </h2>
</x-slot>

<x-container-no-overflow>
    <div class="mb-4 flex gap-2 w-full justify-end">
        <x-datetime-picker placeholder="Pilih tanggal" parse-format="YYYY-MM-DD" wire:model="tanggal" without-time
            display-format="DD-MM-YYYY" />

        <x-native-select wire:model="idTahapanApbd">
            <option selected>Pilih tahapan APBD</option>
            @foreach ($tahapanApbds as $tahapan)
            <option value="{{ $tahapan->id }}">{{ $tahapan->tahun }} - {{ $tahapan->nama}}</option>
            @endforeach
        </x-native-select>
    </div>

    <div class="flex flex-col gap-y-4">

        <x-table.index :model="$realisasiApbds">

            <x-slot name="table_actions">
                <x-button primary label="Tambah" />
            </x-slot>

            <x-table.thead>
                <tr>
                    <x-table.th>
                        Sub Opd
                    </x-table.th>
                    <x-table.th>
                        Sub Kegiatan
                    </x-table.th>
                    <x-table.th>
                        Rekening Belanja
                    </x-table.th>
                    <x-table.th>
                        Anggaran
                    </x-table.th>
                    <x-table.th>
                        Realisasi
                    </x-table.th>
                    <x-table.th>
                        Aksi
                    </x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($realisasiApbds as $realisasiApbd)
                <x-table.tr>
                    <x-table.td>
                        {{ $realisasiApbd->subOpd->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->subKegiatan->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->subRincianObjekBelanja->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->anggaran }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->realisasi }}
                    </x-table.td>

                    <x-table.td>
                        <x-dropdown>

                            <x-dropdown.item icon="pencil" label="Edit" />
                            <x-dropdown.item icon="trash" label="Hapus" x-on:confirm="{
                                    title: 'Anda yakin akan menghapus data?',
                                    icon: 'question',
                                    accept: {
                                        label: 'Hapus',
                                        method: 'hapusRealisasiBelanja',
                                        params: {{ $realisasiApbd->id }}
                                    },
                                    reject: {
                                        label: 'Batal'
                                    }
                                }" />
                        </x-dropdown>
                    </x-table.td>
                </x-table.tr>
                @endforeach
            </tbody>
        </x-table.index>
    </div>
</x-container-no-overflow>