<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Pekerjaan
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$pekerjaans">

        <x-slot name="table_actions">
            <x-button primary :href="route('pekerjaan.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Volume
                </x-table.th>
                <x-table.th>
                    Satuan
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($pekerjaans as $pekerjaan)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $pekerjaan->nama }}
                </x-table.td-utama>
                <x-table.td>
                    {{ $pekerjaan->volume }}
                </x-table.td>
                <x-table.td>
                    {{ $pekerjaan->satuan }}
                </x-table.td>
                <x-table.td>
                    <x-button :href="route('pekerjaan.form', $pekerjaan->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusPekerjaan',
                                params: {{ $pekerjaan->id }}
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
