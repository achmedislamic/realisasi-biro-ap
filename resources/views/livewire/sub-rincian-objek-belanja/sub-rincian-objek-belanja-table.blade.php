<div class="flex flex-col gap-y-4">
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        @if (config('app.mode') != 'pupr')
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $subRincianObjeks->items()[0]->kode_opd ?? '' }}
                    {{ $subRincianObjeks->items()[0]->nama_opd ?? '' }}</p>
            </div>
            <div class="flex gap-x-1 items-center">
                <div class="bg-slate-900 w-2 h-0.5"></div>
                <p>{{ $subRincianObjeks->items()[0]->kode_sub_opd ?? '' }}
                    {{ $subRincianObjeks->items()[0]->nama_sub_opd ?? '' }}</p>
            </div>
        @endif

        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>{{ $subKegiatan->kegiatan->program->kode ?? '' }} {{ $subKegiatan->kegiatan->program->nama ?? '' }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $subKegiatan->kegiatan->kode ?? '' }} {{ $subKegiatan->kegiatan->nama ?? '' }}</p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>{{ $subKegiatan->kode ?? '' }} {{ $subKegiatan->nama ?? '' }}</p>
        </div>
    </div>

    <x-table.index :model="$subRincianObjeks">

        {{-- <x-slot name="table_actions">
            @if ($idRincianObjekBelanja != 0)
            <x-button primary label="Tambah" :href="route('sub-rincian-objek.form', $idRincianObjekBelanja)" />
            @endif
        </x-slot> --}}

        <x-table.thead>
            <tr>
                <x-table.th>
                    #
                </x-table.th>
                @if (filled($menu) && config('app.mode') != 'pupr')
                    <x-table.th>Nama OPD</x-table.th>
                @endif

                <x-table.th>
                    Kode
                </x-table.th>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subRincianObjeks as $key => $subRincianObjek)
                <x-table.tr>
                    <x-table.td>
                        {{ $subRincianObjeks->firstItem() + $key }}
                    </x-table.td>
                    @if (filled($menu) && config('app.mode') != 'pupr')
                        <x-table.td>{{ $subRincianObjek->kode_opd . ' ' . $subRincianObjek->nama_opd }}</x-table.td>
                    @endif
                    <x-table.td>
                        {{ $subRincianObjek->kode }}
                    </x-table.td>
                    <x-table.td wire:click="$emit('subRincianObjekBelanjaClicked', '{{ $subRincianObjek->id }}', '{{ $subKegiatan->id }}', '{{ $menu }}', '{{ $subRincianObjek->id_opd }}', '{{ $subRincianObjek->id_sub_opd }}')" class="hover:underline hover:cursor-pointer hover:text-yellow-500">
                        {{ $subRincianObjek->nama }}
                        <x-loading-indicator />
                    </x-table.td>
                    <x-table.td>
                        <x-button.circle spinner positive xs icon="folder-open"
                            wire:click="$emit('subRincianObjekBelanjaClicked', '{{ $subRincianObjek->id }}', '{{ $subKegiatan->id }}', '{{ $menu }}', '{{ $subRincianObjek->id_opd }}', '{{ $subRincianObjek->id_sub_opd }}')" />
                    </x-table.td>
                </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
