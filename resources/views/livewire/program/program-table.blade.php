x<div class="flex flex-col gap-y-4">

    <x-table.index :model="$programs">

        <x-slot name="table_actions">
            <x-button primary :href="route('program.form')" label="Tambah" />
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
                    Nama
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($programs as $key => $program)
            <x-table.tr>
                <x-table.td>
                    {{ $programs->firstItem() + $key }}
                </x-table.td>
                <x-table.td>
                    {{ $program->kode }}
                </x-table.td>
                <x-table.td class="hover:underline hover:cursor-pointer hover:text-blue-500" wire:click="pilihIdProgramEvent({{ $program->id }}, '{{ $menu }}', '{{ $opdId }}', '{{ $subOpdId }}')">
                    {{ $program->nama }}
                    <x-loading-indicator target="pilihIdProgramEvent({{ $program->id }}, '{{ $menu }}', '{{ $opdId }}', '{{ $subOpdId }}')" />
                </x-table.td>
                <x-table.td>
                    @if ($menu != 'realisasi')
                    <x-button.circle warning xs icon="pencil" :href="route('program.form', $program->id)" />
                        <x-button.circle negative xs icon="trash" x-on:confirm="{
                            title: 'Anda yakin akan menghapus data?',
                            icon: 'question',
                            accept: {
                                label: 'Hapus',
                                method: 'hapusProgram',
                                params: {{ $program->id }}
                            },
                            reject: {
                                label: 'Batal'
                            }
                        }" />
                    @endif

                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdProgramEvent({{ $program->id }}, '{{ $menu }}', '{{ $opdId }}', '{{ $subOpdId }}')" />
                </x-table.td>

            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>
