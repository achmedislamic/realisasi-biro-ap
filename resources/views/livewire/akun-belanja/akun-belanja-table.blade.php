<x-table.index :model="$akuns">
    <x-slot name="table_actions">
        <x-button primary label="Tambah" :href="route('akun.form')" />
    </x-slot>

    <x-table.thead>
        <tr>
            <x-table.th>
                Kode
            </x-table.th>
            <x-table.th>
                Akun
            </x-table.th>
            <x-table.th>
                Aksi
            </x-table.th>
        </tr>
    </x-table.thead>
    <tbody>
        @foreach ($akuns as $akun)
        <x-table.tr>
            <x-table.td>
                {{ $akun->kode }}
            </x-table.td>
            <x-table.td>
                {{ $akun->nama }}
            </x-table.td>
            <x-table.td>
                <x-button.circle warning xs icon="pencil" :href="route('akun.form', $akun->id)" />
                <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusAkun',
                            params: {{ $akun->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />

                <x-button.circle positive xs icon="folder-open" wire:click="pilihIdAkunBelanjaEvent({{ $akun->id }})" />
            </x-table.td>
        </x-table.tr>
        @endforeach
    </tbody>
</x-table.index>