<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pengaturan Kas APBD
    </h2>
</x-slot>

<x-container>
    <x-table.index :model="$subOpds" :isPaginated="false" :searchable="false">
        <x-table.thead>
            <tr>
                <x-table.th rowspan="2">Aksi</x-table.th>
                <x-table.th rowspan="2">Nama Sub OPD</x-table.th>
                <x-table.th colspan="12" class="text-center">Target</x-table.th>
            </tr>
            <tr>
                <x-table.th>Januari</x-table.th>
                <x-table.th>Februari</x-table.th>
                <x-table.th>Maret</x-table.th>
                <x-table.th>April</x-table.th>
                <x-table.th>Mei</x-table.th>
                <x-table.th>Juni</x-table.th>
                <x-table.th>Juli</x-table.th>
                <x-table.th>Agustus</x-table.th>
                <x-table.th>September</x-table.th>
                <x-table.th>Oktober</x-table.th>
                <x-table.th>November</x-table.th>
                <x-table.th>Desember</x-table.th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($subOpds as $subOpd)
            <x-table.tr>
                <x-table.td>
                    <x-button :href="route('target.form', ['subOpdId' => $subOpd->id, 'mode' => 'subOpd'])" label="Ubah" warning icon="pencil" />
                </x-table.td>
                <x-table.td-utama>
                    {{ $subOpd->teks_lengkap }}
                </x-table.td-utama>
                @for ($i = 1; $i <= 12; $i++)
                <x-table.td>
                    {{ \App\Helpers\FormatHelper::angka($subOpd->targets->where('bulan', $i)->first()?->jumlah ?? 0) }}
                </x-table.td>
                @endfor
            </x-table.tr>
            @endforeach
        </tbody>
    </x-table.index>
</x-container>
