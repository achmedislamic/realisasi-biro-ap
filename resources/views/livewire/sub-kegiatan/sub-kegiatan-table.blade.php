<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $kegiatan->program->kode ?? "" }} {{ $kegiatan->program->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $kegiatan->kode ?? "" }} {{ $kegiatan->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$subKegiatans">

        <x-slot name="table_actions">
            @if ($idKegiatan != 0)
            <x-button primary :href="route('sub-kegiatan.form', $idKegiatan)" label="Tambah" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subKegiatans as $key => $subKegiatan)
            <x-table.tr>
                <x-table.td>
                    {{ $subKegiatans->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $subKegiatan->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $subKegiatan->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('sub-kegiatan.form', [$idKegiatan, $subKegiatan->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusSubKegiatan',
                            params: {{ $kegiatan->id }}
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