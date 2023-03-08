<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah - OPD
    </h2>
</x-slot>

<x-container>
    <div class="bg-orange-300 mb-6 pl-4 py-1">
        <div class="flex justify-between mr-4 mb-1">
            <h4 class="font-semibold">{{ $bidangUrusan->urusan->nama }}</h4>
            <x-button.circle white xs icon="folder-open" :href="route('perangkat-daerah')" />
        </div>
        <div class="bg-blue-300 px-4 py-1">
            <div class="flex justify-between">
                <h4 class="font-semibold">{{ $bidangUrusan->nama }}</h4>
                <x-button.circle white xs icon="folder-open"
                    :href="route('bidang-urusan', $bidangUrusan->urusan->id)" />
            </div>
        </div>
    </div>

    <x-table.index :model="$opds">

        <x-slot name="table_actions">
            <x-button primary label="Tambah" :href="route('opd.form', $bidangUrusan->id)" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    OPD
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($opds as $opd)
            <x-table.tr>
                <x-table.td>
                    {{ $opd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('opd.form', [$bidangUrusan->id, $opd->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusOpd',
                                params: {{ $opd->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    <x-button.circle positive xs icon="folder-open" :href="route('sub-unit', $opd->id)" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>