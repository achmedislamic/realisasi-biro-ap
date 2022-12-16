<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Satuan
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$satuans">

        <x-slot name="table_actions">
            <x-button primary :href="route('satuan.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Nama
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
            @foreach ($satuans as $satuan)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $satuan->nama }}
                </x-table.td-utama>
                <x-table.td>
                    {{ $satuan->satuan }}
                </x-table.td>
                <x-table.td>
                    <x-button :href="route('satuan.form', $satuan->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusSatuan',
                                params: {{ $satuan->id }}
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
