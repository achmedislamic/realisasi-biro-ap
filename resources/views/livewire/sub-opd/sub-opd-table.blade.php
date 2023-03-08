<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Perangkat Daerah - Sub Unit
    </h2>
</x-slot>

<x-container>
    <div class="bg-orange-300 mb-6 pl-4 py-1">
        <div class="flex justify-between mr-4 mb-1">
            <h4 class="font-semibold">{{ $opd->bidangUrusan->urusan->nama }}</h4>
            <x-button.circle white xs icon="folder-open" :href="route('perangkat-daerah')" />
        </div>
        <div class="bg-blue-300 pl-4 py-1 mb-1">
            <div class="flex justify-between mr-4 mb-1">
                <h4 class="font-semibold">{{ $opd->bidangUrusan->nama }}</h4>
                <x-button.circle white xs icon="folder-open"
                    :href="route('bidang-urusan', $opd->bidangUrusan->urusan->id)" />
            </div>
            <div class="bg-purple-300 px-4 py-1 mb-1">
                <div class="flex justify-between">
                    <h4 class="font-semibold">{{ $opd->nama }}</h4>
                    <x-button.circle white xs icon="folder-open" :href="route('opd', $opd->bidangUrusan->id)" />
                </div>
            </div>
        </div>
    </div>

    <x-table.index :model="$subOpds">

        <x-slot name="table_actions">
            <x-button primary label="Tambah" :href="route('sub-opd.form', $opd->id)" />
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Sub Opd
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subOpds as $subOpd)
            <x-table.tr>
                <x-table.td>
                    {{ $subOpd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('sub-unit.form', [$opd->id, $subOpd->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusSubUnit',
                                params: {{ $subOpd->id }}
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
