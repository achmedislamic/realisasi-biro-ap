<x-container>
    <x-table.index :model="$users">
        <x-table.thead>
            <tr>
                <x-table.th>
                    Nama
                </x-table.th>
                <x-table.th>
                    Email
                </x-table.th>
                <x-table.th>
                    Aksi
                </x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($users as $user)
            <x-table.tr>
                <x-table.td-utama>
                    {{ $user->name }}
                </x-table.td-utama>
                <x-table.td>
                    {{ $user->email }}
                </x-table.td>
                <x-table.td>
                    <x-button
                        :href="route('pengguna.form', $user->id)"
                        label="Ubah"
                        warning
                        icon="pencil"
                    />

                     @if ($konfirmasi === $user->id)
                        <x-button
                            wire:click="destroy({{ $user->id }})"
                            icon="x"
                            dark
                            label="Anda Yakin?"
                        />
                     @else
                        <x-button
                            wire:click="konfirmasiHapus({{ $user->id }})"
                            icon="x"
                            negative
                            label="Hapus"
                        />
                     @endif
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>
