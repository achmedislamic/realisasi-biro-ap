<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $opd->bidangUrusans[0]->urusan->kode ?? "" }} {{ $opd->bidangUrusans[0]->urusan->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $opd->bidangUrusans[0]->kode ?? "" }} {{ $opd->bidangUrusans[0]->nama ?? "" }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>{{ $opd->kode ?? "" }} {{ $opd->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$subOpds">

        <x-slot name="table_actions">
            @if ($idOpd != 0)
            <x-button primary label="Tambah" :href="route('sub-opd.form', [$idOpd, $idBidangUrusan])" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Sub Opd
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subOpds as $key => $subOpd)
            <x-table.tr>
                <x-table.td>
                    {{ $subOpds->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $subOpd->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $subOpd->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('sub-opd.form', [$opd->id, $idBidangUrusan, $subOpd->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                                    title: 'Anda yakin akan menghapus data?',
                                    icon: 'question',
                                    accept: {
                                        label: 'Hapus',
                                        method: 'hapusSubOpd',
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
</div>