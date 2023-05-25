<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tabel Pengguna
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$userRoles">
        <x-slot:table_actions>
            <x-button primary :href="route('pengguna.form')" label="Tambah" />
        </x-slot:table_actions>
        <x-table.thead>
            <tr>
                <x-table.th-sort sortBy="name" :$sortField :$sortAsc>
                    Nama
                </x-table.th-sort>
                <x-table.th-sort sortBy="email" :$sortField :$sortAsc>
                    Email
                </x-table.th-sort>
                <x-table.th>
                    OPD / Sub OPD
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($userRoles as $userRole)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $userRole->user->name }}
                </x-table.td-utama>
                <x-table.td>
                    {{ $userRole->user->email }}
                </x-table.td>
                <x-table.td>
                    {{ \App\Models\UserRole::find($userRole->id)->imageable->nama ?? '-' }}
                </x-table.td>
                <x-table.td>
                    <x-button :href="route('pengguna.form', $userRole->user->id)" label="Ubah" warning icon="pencil" />

                    @if ($konfirmasi === $userRole->user->id)
                    <x-button wire:click="destroy({{ $userRole->user->id }})" icon="x" dark label="Anda Yakin?" />
                    @else
                    <x-button wire:click="konfirmasiHapus({{ $userRole->user->id }})" icon="x" negative label="Hapus" />
                    @endif
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>
