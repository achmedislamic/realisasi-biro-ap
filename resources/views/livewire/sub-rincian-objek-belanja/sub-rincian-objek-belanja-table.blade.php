<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">
            {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
            {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
        </p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
            <div class="border-l-[24px] border-l-blue-200">
                <p class="pl-2">
                    {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kode ?? "" }}
                    {{$rincianObjekBelanja->objekBelanja->jenisBelanja->nama ?? ""}}
                </p>
                <div class="border-l-[24px] border-l-gray-400">
                    <p class="pl-2">{{ $rincianObjekBelanja->objekBelanja->kode ?? "" }}
                        {{ $rincianObjekBelanja->objekBelanja->nama ?? "" }}</p>
                    <div class="border-l-[24px] border-l-gray-200">
                        <p class="pl-2">
                            {{ $rincianObjekBelanja->kode ?? "" }}
                            {{$rincianObjekBelanja->nama ?? "" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <x-table.index :model="$subRincianObjekBelanjas">

        <x-slot name="table_actions">
            @if ($idRincianObjekBelanja != 0)
            <x-button primary label="Tambah" :href="route('sub-rincian-objek.form', $idRincianObjekBelanja)" />
            @endif
        </x-slot>

        <x-table.thead>
            <tr>
                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Sub Rincian Objek Belanja
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subRincianObjekBelanjas as $subRincianObjek)
            <x-table.tr>
                <x-table.td>
                    {{ $subRincianObjek->kode }}
                </x-table.td>
                <x-table.td>
                    {{ $subRincianObjek->nama }}
                </x-table.td>
                <x-table.td>
                    <x-button.circle warning xs icon="pencil"
                        :href="route('sub-rincian-objek.form', [$idRincianObjekBelanja, $subRincianObjek->id])" />
                    <x-button.circle negative xs icon="trash" x-on:confirm="{
                        title: 'Anda yakin akan menghapus data?',
                        icon: 'question',
                        accept: {
                            label: 'Hapus',
                            method: 'hapusSubRincianObjekBelanja',
                            params: {{ $subRincianObjek->id }}
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