<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 pl-2 text-slate-900">
        <p class="pl-2">{{ $akunBelanja->kode ?? "" }} {{ $akunBelanja->nama ?? "" }}</p>
    </div>
    <hr>
    <x-table.index :model="$kelompokBelanjas">

        <x-slot name="table_actions">
            @if ($idAkunBelanja != 0)
            <x-button primary label="Tambah" :href="route('kelompok.form', $idAkunBelanja)" />
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
            @foreach ($kelompokBelanjas as $kelompok)
            <x-table.tr>
                <x-table.td>
                    {{ $kelompok->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $kelompok->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('kelompok.form', [$idAkunBelanja, $kelompok->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                                title: 'Anda yakin akan menghapus data?',
                                icon: 'question',
                                accept: {
                                    label: 'Hapus',
                                    method: 'hapusKelompokBelanja',
                                    params: {{ $kelompok->id }}
                                },
                                reject: {
                                    label: 'Batal'
                                }
                            }" />

                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdKelompokBelanjaEvent({{ $kelompok->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>