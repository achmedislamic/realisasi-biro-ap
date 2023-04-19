<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Rincian Masalah
    </h2>
</x-slot>

<x-container>
    <div class="mb-4 bg-slate-100 p-3 rounded-md flex gap-2">
        <table>
            <tbody>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">OPD</td>
                    <td class="text-sm">{{ $subOpd->opd->kode . ' ' .$subOpd->opd->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Sub OPD/UPT</td>
                    <td class="text-sm">{{ $subOpd->kode . ' ' . $subOpd->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Program</td>
                    <td class="text-sm">{{ $subKegiatan->kegiatan->program->kode . ' ' . $subKegiatan->kegiatan->program->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Kegiatan</td>
                    <td class="text-sm">{{ $subKegiatan->kegiatan->kode . ' ' . $subKegiatan->kegiatan->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Sub Kegiatan</td>
                    <td class="text-sm">{{ $subKegiatan->kode . ' ' . $subKegiatan->nama }}</td>
                </tr>
                <tr>
                    <td class="pr-5 font-semibold text-sm text-gray-400">Anggaran</td>
                    <td class="text-sm">Rp. {{ \App\Helpers\FormatHelper::angka($jumlahAnggaran) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <form wire:submit.prevent="simpan">
            <div class="flex flex-col space-y-3">
                <div class="w-full">
                    <x-native-select label="Periode" wire:model="triwulan">
                        <option value="">Silakan Pilih</option>
                        <option value="1">Triwulan 1</option>
                        <option value="2">Triwulan 2</option>
                        <option value="3">Triwulan 3</option>
                        <option value="4">Triwulan 4</option>
                        <option value="0">Tahunan</option>
                    </x-native-select>
                </div>

                <div class="w-full">
                    <p>Target {{ $triwulan == 0 ? 'Tahunan ' . cache('tahapanApbd')->tahun : 'Triwulan ' . $triwulan }}:</p>
                    <p>Realisasi: {{ $jumlahRealisasi }}</p>
                </div>

                <div class="w-full">
                    <x-textarea wire:model.defer="rincianMasalah.kendala" label="Kendala" />
                </div>
                <div class="w-full">
                    <x-textarea wire:model.defer="rincianMasalah.tindak_lanjut" label="Tindak Lanjut" />
                </div>
                <div class="w-full">
                    <x-input wire:model.defer="rincianMasalah.pihak" label="Pihak" />
                </div>
                <div class="flex justify-between">
                    <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                    <x-button type="submit" positive label="Simpan" />
                </div>
            </div>
        </form>
    </div>


</x-container>
