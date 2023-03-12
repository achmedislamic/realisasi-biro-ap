<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">{{ $kelompokBelanja->akunBelanja->kode ?? "" }} {{ $kelompokBelanja->akunBelanja->nama ?? "" }}
        </p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">{{ $kelompokBelanja->kode ?? "" }} {{ $kelompokBelanja->nama ?? "" }}</p>
        </div>
    </div>
    <hr>
    <x-table.index :model="$jenisBelanjas">

        <x-slot name="table_actions">
            @if ($idKelompokBelanja != 0)
            <x-button primary label="Tambah" :href="route('jenis.form', $idKelompokBelanja)" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Kelompok Belanja
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($jenisBelanjas as $jenis)
            <x-table.tr>
                <x-table.td>
                    {{ $jenis->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $jenis->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('jenis.form', [$idKelompokBelanja, $jenis->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                                title: 'Anda yakin akan menghapus data?',
                                icon: 'question',
                                accept: {
                                    label: 'Hapus',
                                    method: 'hapusJenisBelanja',
                                    params: {{ $jenis->id }}
                                },
                                reject: {
                                    label: 'Batal'
                                }
                            }" />

                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdJenisBelanjaEvent({{ $jenis->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>