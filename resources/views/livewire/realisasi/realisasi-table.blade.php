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

        <x-table.scrollable :model="$realisasiApbds" class="w-[2000px]">

            <x-slot name="table_actions">
                <x-button primary label="Tambah" :href="route('realisasi.form')" />
            </x-slot>

            <x-table.thead>
                <tr>
                    <x-table.th>
                        Opd
                    </x-table.th>
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
                        {{ $realisasiApbd->subOpd->opd->kode." ".$realisasiApbd->subOpd->opd->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->subOpd->kode." ".$realisasiApbd->subOpd->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->subKegiatan->kode." ".$realisasiApbd->subKegiatan->nama }}
                    </x-table.td>
                    <x-table.td>
                        {{ $realisasiApbd->subRincianObjekBelanja->kode." ".$realisasiApbd->subRincianObjekBelanja->nama
                        }}
                    </x-table.td>
                    <x-table.td>
                        {{ number_format($realisasiApbd->anggaran, 2, ',', '.') }}
                    </x-table.td>
                    <x-table.td>
                        {{ number_format($realisasiApbd->realisasi, 2, ',', '.') }}
                    </x-table.td>

                    <x-table.td>
                        <x-button.circle warning xs icon="pencil"
                            :href="route('realisasi.form', [$realisasiApbd->id])" />
                        {{--
                        <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data realisasi ini?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusSubUnit',
                                params: {{ $subOpd->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" /> --}}
                    </x-table.td>
                </x-table.tr>
                @endforeach
            </tbody>
        </x-table.scrollable>
    </div>
</x-container-no-overflow>