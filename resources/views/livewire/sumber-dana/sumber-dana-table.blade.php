<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Sumber Dana
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$sumberDanas">

        <x-slot name="table_actions">
            <x-button primary :href="route('sumber-dana.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($sumberDanas as $sumberDana)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $sumberDana->nama }}
                </x-table.td-utama>
                <x-table.td>
                    <x-button :href="route('sumber-dana.form', $sumberDana->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusKategori',
                                params: {{ $sumberDana->id }}
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
