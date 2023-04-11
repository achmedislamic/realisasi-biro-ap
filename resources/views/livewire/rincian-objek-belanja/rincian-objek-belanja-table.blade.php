<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>
                {{ $objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
                {{ $objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>
                {{ $objekBelanja->jenisBelanja->kelompokBelanja->kode ?? "" }}
                {{ $objekBelanja->jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>{{ $objekBelanja->jenisBelanja->kode ?? "" }} {{ $objekBelanja->jenisBelanja->nama ?? ""}}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-10 h-0.5"></div>
            <p>{{ $objekBelanja->kode ?? "" }} {{ $objekBelanja->nama ?? "" }}</p>
        </div>
    </div>

    <x-table.index :model="$rincianObjekBelanjas">

        <x-slot name="table_actions">
            @if ($idObjekBelanja != 0)
            <x-button primary label="Tambah" :href="route('rincian-objek.form', $idObjekBelanja)" />
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
                    Rincian Objek Belanja
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($rincianObjekBelanjas as $key => $rincianObjek)
            <x-table.tr>
                <x-table.td>
                    {{ $rincianObjekBelanjas->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $rincianObjek->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $rincianObjek->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('rincian-objek.form', [$idObjekBelanja, $rincianObjek->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusRincianObjekBelanja',
                            params: {{ $rincianObjek->id }}
                        },
                        reject: {
                            label: 'Batal'
                        }
                    }" />
                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdRincianObjekBelanjaEvent({{ $rincianObjek->id }})" />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>