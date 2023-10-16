<div class="flex flex-col gap-y-4">
    {{-- <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kode ?? "" }}
                {{$rincianObjekBelanja->objekBelanja->jenisBelanja->nama ?? ""}}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-10 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-12 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->kode ?? "" }}
                {{$rincianObjekBelanja->nama ?? "" }}
            </p>
        </div>
    </div>

    <x-table.index :model="$subRincianObjekBelanjas">

        <x-slot name="table_actions">
            @if ($idRincianObjekBelanja != 0)
            <x-button primary label="Tambah" :href="route('sub-rincian-objek.form', $idRincianObjekBelanja)" />
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
                    Sub Rincian Objek Belanja
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subRincianObjekBelanjas as $key => $subRincianObjek)
            <x-table.tr>
                <x-table.td>
                    {{ $subRincianObjekBelanjas->firstItem() + $key }}
                </x-table.td>
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
    </x-table.index> --}}

    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, quas et? Consequatur dolorem harum perferendis cum,
    atque magni architecto aspernatur reprehenderit. Doloremque possimus ducimus velit tenetur. Quis hic incidunt
    fugiat.
    Molestiae qui provident assumenda. Quis, dolore hic minima incidunt velit possimus repellat consectetur modi ut,
    consequuntur magni quas accusantium recusandae. Quasi aspernatur tenetur doloremque. Quibusdam ullam minus amet et
    esse.
    Veritatis, debitis id? Nam ipsa doloremque natus quidem! Nihil dicta accusamus sed et dolor est assumenda temporibus
    consequuntur soluta! Sunt molestiae facere eaque officia autem numquam perspiciatis soluta qui ut.
    Quaerat molestiae et quibusdam! Vitae dolorem totam vero laborum. Repudiandae sed quo voluptatem dolorem ab esse
    exercitationem numquam itaque tenetur officia. Nesciunt atque incidunt sapiente accusamus culpa consectetur cumque
    tempora!
    Consectetur fugit minus necessitatibus rem, distinctio dolorem mollitia veritatis numquam pariatur sequi molestiae
    adipisci voluptate rerum nesciunt, assumenda voluptatibus ab alias aperiam libero illum. Voluptatum cum vel fugiat
    expedita distinctio!
</div>
