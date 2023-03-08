<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah - Bidang Urusan
    </h2>
</x-slot>

<x-container>
    <div class="bg-orange-300 mb-6 px-4 py-1">
        <div class="flex justify-between">
            <h4 class="font-semibold">{{ $urusan->nama }}</h4>
            <x-button.circle white xs icon="folder-open" :href="route('perangkat-daerah')" />
        </div>
    </div>

    <x-table.index :model="$bidangUrusans">

        <x-slot name="table_actions">
            <x-button primary label="Tambah" :href="route('bidang-urusan.form', $urusan->id)" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Bidang Urusan
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($bidangUrusans as $bidangUrusan)
            <x-table.tr>
                <x-table.td>
                    {{ $bidangUrusan->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('bidang-urusan.form', [$bidangUrusan->urusan->id, $bidangUrusan->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusBidangUrusan',
                                params: {{ $bidangUrusan->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    <x-button.circle positive xs icon="folder-open" :href="route('opd', [$bidangUrusan->id])" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>