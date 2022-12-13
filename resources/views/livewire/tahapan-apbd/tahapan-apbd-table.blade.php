<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Tahapan APBD
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$tahapanApbds">

        <x-slot name="table_actions">
            <x-button primary :href="route('tahapan-apbd.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Nama Tahapan APBD
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($tahapanApbds as $tahapanApbd)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $tahapanApbd->nama }}
                </x-table.td-utama>
                <x-table.td>
                    <x-button :href="route('tahapan-apbd.form', $tahapanApbd->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusTahapanApbd',
                                params: {{ $tahapanApbd->id }}
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
