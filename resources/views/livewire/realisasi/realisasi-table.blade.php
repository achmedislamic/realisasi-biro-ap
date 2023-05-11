<div>

    <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2">
        @if ($objekRealisasi)
        <table>
            <tbody>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">OPD</td>
                    <td class="text-sm">{{ $objekRealisasi->bidangUrusanSubOpd->subOpd->opd->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Sub OPD</td>
                    <td class="text-sm">{{ $objekRealisasi->bidangUrusanSubOpd->subOpd->nama }}</td>
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
                    <td>Rp. {{ \App\Helpers\FormatHelper::angka($objekRealisasi->anggaran) }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Total Realisasi Keuangan</td>
                    <td>Rp. {{ \App\Helpers\FormatHelper::angka($realisasis->sum('jumlah')) }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Target Fisik</td>
                    <td>{{ blank($objekRealisasi->target) ? '(Belum di-input)' : $objekRealisasi->target . '' . $objekRealisasi->satuan->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Realisasi Fisik</td>
                    <td>{{ $objekRealisasi->realisasiFisiks->sum('jumlah') }}%</td>
                </tr>
            </tbody>
        </table>
        @else
        <h1 class="tracking-widest font-semibold text-lg">LOADING...</h1>
        @endif
    </div>
    <div x-data="{ tab: 'uang' }">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li class="mr-2" role="presentation">
                    <button @click="tab = 'uang'"
                            :class="tab == 'uang' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                            class="inline-block p-4 border-b-2 rounded-t-lg" id="uang-tab"
                            data-tabs-target="#uang" type="button" role="tab"
                            aria-selected="false">Keuangan</button>
                </li>

                <li class="mr-2" role="presentation">
                    <button @click="tab = 'fisik'"
                            :class="tab == 'fisik' ? 'text-blue-600 font-bold border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' : ''"
                            class="inline-block p-4 border-b-2 rounded-t-lg" id="fisik-tab"
                            data-tabs-target="#fisik" type="button" role="tab"
                            aria-selected="false">Fisik</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div x-show="tab == 'uang'" x-transition>
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
            <div x-show="tab == 'fisik'" x-transition>
                <x-table.index :model="$realisasiFisiks" :isPaginated="false">
                    <x-slot name="table_actions">
                        <x-button primary label="Tambah" :href="route('realisasi-fisik.form', $objekRealisasiId)" />
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
                        @foreach ($realisasiFisiks as $key => $realisasiFisik)
                        <x-table.tr>
                            <x-table.td>
                                {{ $loop->iteration }}
                            </x-table.td>
                            <x-table.td>
                                {{ \App\Helpers\FormatHelper::tanggal($realisasiFisik->tanggal) }}
                            </x-table.td>
                            <x-table.td>
                                {{ \App\Helpers\FormatHelper::angka($realisasiFisik->jumlah) }}
                            </x-table.td>
                            <x-table.td>
                                <x-button.circle warning xs icon="pencil"
                                    :href="route('realisasi-fisik.form', [$objekRealisasiId, $realisasiFisik->id])" />
                                <x-button.circle negative xs icon="trash" x-on:confirm="{
                                    title: 'Anda yakin akan menghapus data realisasi ini?',
                                    icon: 'question',
                                    accept: {
                                        label: 'Hapus',
                                        method: 'hapusRealisasi',
                                        params: {{ $realisasiFisik->id }}
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
        </div>
    </div>

</div>
