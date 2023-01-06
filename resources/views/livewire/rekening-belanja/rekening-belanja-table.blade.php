<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Rekening Belanja
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$rekeningBelanjas">

        <x-slot name="table_actions">
            <x-button primary :href="route('rekening-belanja.form')" label="Tambah" />
            <x-button green :href="route('rekening-belanja.form-upload')" label="Upload Excel" />
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
            @foreach ($rekeningBelanjas as $rekeningBelanja)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $rekeningBelanja->kode }}
                </x-table.td-utama>
                <x-table.td-utama>
                    {{ $rekeningBelanja->nama }}
                </x-table.td-utama>
                <x-table.td>
                    <x-button :href="route('rekening-belanja.form', $rekeningBelanja->id)" label="Ubah" warning
                        icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapuRekeningBelanja',
                                params: {{ $rekeningBelanja->id }}
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
