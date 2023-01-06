<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Anggota DPRD
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$anggotaDprds">

        <x-slot name="table_actions">
            <x-button primary :href="route('anggota-dprd.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Periode
                </x-table.th>
                <x-table.th>
                    Fraksi
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
            @foreach ($anggotaDprds as $anggotaDprd)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $anggotaDprd->awal_periode }}
                </x-table.td-utama>
                <x-table.td>
                    {{ $anggotaDprd->fraksi }}
                </x-table.td>
                <x-table.td>
                    {{ $anggotaDprd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button :href="route('anggota-dprd.form', $anggotaDprd->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusAnggotaDprd',
                                params: {{ $anggotaDprd->id }}
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
</x-container>
