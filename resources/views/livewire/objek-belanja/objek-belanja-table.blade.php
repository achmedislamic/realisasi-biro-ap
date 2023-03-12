<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">
            {{ $jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
            {{ $jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
        </p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">
                {{ $jenisBelanja->kelompokBelanja->kode ?? "" }} {{ $jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
            <div class="border-l-[24px] border-l-blue-200">
                <p class="pl-2">{{ $jenisBelanja->kode ?? "" }} {{ $jenisBelanja->nama ?? "" }}</p>
            </div>
        </div>
    </div>

    <hr>

    <x-table.index :model="$objekBelanjas">

        <x-slot name="table_actions">
            @if ($idJenisBelanja != 0)
            <x-button primary label="Tambah" :href="route('objek.form', $idJenisBelanja)" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
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
            @foreach ($objekBelanjas as $objek)
            <x-table.tr>
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