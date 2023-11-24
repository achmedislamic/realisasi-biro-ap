<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Realisasi Fisik
    </h2>
</x-slot>

<x-container-no-overflow class="overflow-visible">
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-input label="OPD" disabled wire:model="pod" />
                </div>

                <div class="w-full">
                    <x-input label="Sub OPD" disabled wire:model="subOpd" />
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-input label="Program" disabled wire:model="program" />
                </div>

                <div class="w-full">
                    <x-input label="Kegiatan" disabled wire:model="kegiatan" />
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-input label="Sub Kegiatan" disabled wire:model="subKegiatan" />
                </div>

                <div class="w-full">
                    <x-input label="Rekening Belanja" disabled wire:model="subRincianObjekBelanja" />
                </div>
            </div>

            <div class="flex gap-x-4">

                <div class="w-full">
                    <x-input label="Rekening Belanja" disabled wire:model="rincianBelanja" />
                </div>
            </div>

            <div class="flex flex-row">
                <div class="w-full">
                    <x-datetime-picker label="Tanggal Realisasi" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD"
                        display-format="DD-MM-YYYY" wire:model.defer="realisasiFisik.tanggal" without-time
                        display-format="DD-MM-YYYY" />
                </div>
            </div>

            <div class="flex gap-x-4 items-start">
                <div class="w-full flex flex-row space-x-3 items-end">
                    <div class="w-full">
                        <x-input label="Target Fisik" disabled wire:model="target" />
                    </div>
                    <div class="w-full">
                        <p>{{ $objekRealisasi->satuan->nama }}</p>
                    </div>
                </div>

                <div class="w-full">
                    <x-inputs.currency
                        label="Realisasi Fisik (Dalam Persen)"
                        hint="Jika angka memiliki desimal, gunakan tanda titik (.) sebagai pemisah"
                        wire:model.defer="realisasiFisik.jumlah"
                    />
                </div>

                <div class="w-full">
                    <p>Realisasi yang sudah terinput sebelumnya: {{ $totalRealisasi }}%</p>
                </div>
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button spinner type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container-no-overflow>
