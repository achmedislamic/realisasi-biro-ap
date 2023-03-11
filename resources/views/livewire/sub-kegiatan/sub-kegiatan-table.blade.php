<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">{{ $kegiatan->program->kode ?? "" }} {{ $kegiatan->program->nama ?? "" }}</p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">{{ $kegiatan->kode ?? "" }} {{ $kegiatan->nama ?? "" }}</p>
        </div>
    </div>

    <hr>

    <x-table.index :model="$subKegiatans">

        <x-slot name="table_actions">
            @if ($idKegiatan != 0)
            <x-button primary :href="route('sub-kegiatan.form', $idKegiatan)" label="Tambah" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
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
            @foreach ($subKegiatans as $subKegiatan)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $subKegiatan->kode }}
                </x-table.td-utama>
                <x-table.td-utama>
                    {{ $subKegiatan->nama }}
                </x-table.td-utama>
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