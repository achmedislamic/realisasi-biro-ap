<div class="flex flex-col gap-y-4">
    <div class="border-l-4 border-blue-700 text-slate-900">
        <p class="pl-2">{{ $bidangUrusan->urusan->kode ?? "" }} {{ $bidangUrusan->urusan->nama ?? "" }}</p>
        <div class="border-l-[24px] border-l-blue-400">
            <p class="pl-2">{{ $bidangUrusan->kode ?? "" }} {{ $bidangUrusan->nama ?? "" }}</p>
        </div>
    </div>

    <hr>

    <x-table.index :model="$programs">

        <x-slot name="table_actions">
            <x-button primary :href="route('program.form')" label="Tambah" />
        </x-slot>

        <x-table.thead>
            <tr>
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
            @foreach ($programs as $program)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $program->kode }}
                </x-table.td-utama>
                <x-table.td-utama>
                    {{ $program->nama }}
                </x-table.td-utama>
                <x-table.td>
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
                    <x-button.circle positive xs icon="folder-open"
                        wire:click="pilihIdProgramEvent({{ $program->id }})" />
                </x-table.td>

            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</div>