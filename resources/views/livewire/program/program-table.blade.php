<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Program
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$programs">

        <x-slot name="table_actions">
            <x-button primary :href="route('program.form')" label="Tambah" />
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
            @foreach ($programs as $program)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $program->kode }}
                </x-table.td-utama>
                <x-table.td-utama>
                    {{ $program->nama }}
                </x-table.td-utama>
                <x-table.td>
                    <x-button :href="route('program.form', $program->id)" label="Ubah" warning icon="pencil" />
                    <x-button label="Hapus" negative icon="x" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusProgram',
                                params: {{ $program->id }}
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
