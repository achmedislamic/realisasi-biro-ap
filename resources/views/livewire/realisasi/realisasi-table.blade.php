<div>
    <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2">
        @if ($objekRealisasi)
        <table>
            <tbody>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">OPD</td>
                    <td class="text-sm">{{ $objekRealisasi->subOpd->opd->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Sub OPD</td>
                    <td class="text-sm">{{ $objekRealisasi->subOpd->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Program</td>
                    <td class="text-sm">{{ $objekRealisasi->subKegiatan->kegiatan->program->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Kegiatan</td>
                    <td class="text-sm">{{ $objekRealisasi->subKegiatan->kegiatan->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Sub Kegiatan</td>
                    <td class="text-sm">{{ $objekRealisasi->subKegiatan->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Rekening Belanja</td>
                    <td class="text-sm">{{ $objekRealisasi->subRincianObjekBelanja->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Anggaran</td>
                    <td>Rp. {{ number_format($objekRealisasi->anggaran, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Total Realisasi</td>
                    <td>Rp. {{ \App\Helpers\FormatHelper::angka($realisasis->sum('jumlah')) }}</td>
                </tr>
            </tbody>
        </table>
        @else
        <h1 class="tracking-widest font-semibold text-lg">LOADING...</h1>
        @endif
    </div>

    <x-table.index :model="$realisasis">
        <x-slot name="table_actions">
            <x-button primary label="Tambah" :href="route('realisasi.form', $objekRealisasiId)" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
                <x-table.th>
                    Tanggal
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
            @foreach ($realisasis as $key => $realisasi)
            <x-table.tr>
                <x-table.td>
                    {{ $realisasis->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ \App\Helpers\FormatHelper::tanggal($realisasi->tanggal) }}
                </x-table.td>
                <x-table.td>
                    {{ \App\Helpers\FormatHelper::angka($realisasi->jumlah) }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('realisasi.form', [$objekRealisasiId, $realisasi->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data realisasi ini?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusRealisasi',
                            params: {{ $realisasi->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
