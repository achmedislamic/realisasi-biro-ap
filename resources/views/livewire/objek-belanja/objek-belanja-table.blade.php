<div class="flex flex-col gap-y-4">

    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>
                {{ $jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
                {{ $jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>
                {{ $jenisBelanja->kelompokBelanja->kode ?? "" }} {{ $jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>{{ $jenisBelanja->kode ?? "" }} {{ $jenisBelanja->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$objekBelanjas">

        <x-slot name="table_actions">
            @if ($idJenisBelanja != 0)
            <x-button primary label="Tambah" :href="route('objek.form', $idJenisBelanja)" />
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
                    Objek Belanja
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($objekBelanjas as $key => $objek)
            <x-table.tr>
                <x-table.td>
                    {{ $objekBelanjas->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $objek->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $objek->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('objek.form', [$idJenisBelanja, $objek->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusObjekBelanja',
                            params: {{ $objek->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />
                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdObjekBelanjaEvent({{ $objek->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>