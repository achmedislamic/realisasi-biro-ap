<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">
            {{ $opd->bidangUrusans[0]->urusan->kode ?? "" }} {{ $opd->bidangUrusans[0]->urusan->nama ?? "" }}
        </p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">{{ $opd->bidangUrusans[0]->kode ?? "" }} {{ $opd->bidangUrusans[0]->nama ?? "" }}</p>

            <div class="border-l-[24px] border-l-blue-200">
                <p class="pl-2">{{ $opd->kode ?? "" }} {{ $opd->nama ?? "" }}</p>
            </div>
        </div>
    </div>

    <hr>

    <x-table.index :model="$subOpds">

        <x-slot name="table_actions">
            @if ($idOpd != 0)
            <x-button primary label="Tambah" :href="route('sub-opd.form', [$idOpd, $idBidangUrusan])" />
            @endif
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
                    <x-button.circle warning xs icon="pencil" :href="route('sub-opd.form', [$opd->id, $subOpd->id])" />
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
</div>