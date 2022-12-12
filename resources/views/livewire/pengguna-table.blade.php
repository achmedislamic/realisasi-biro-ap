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
                    
                </x-table.td>
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>
