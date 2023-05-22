<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Realisasi
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

            <div class="flex flex-row">
                <div class="w-full">
                    <x-datetime-picker label="Tanggal Realisasi" placeholder="Pilih tanggal" parse-format="YYYY-MM-DD" wire:model.defer="realisasi.tanggal" without-time
                        display-format="DD-MM-YYYY" />
                </div>
            </div>

            <div class="flex gap-x-4 items-end">
                <div class="w-full">
                    <x-input label="Anggaran" disabled wire:model="anggaran" />
                </div>

                <div class="w-full">
                    <x-inputs.currency
                        label="Realisasi"
                        thousands="."
                        decimal=","
                        precision="4"
                        wire:model.lazy="realisasi.jumlah"
                    />
                </div>

                <div class="w-full">
                    <p>Realisasi yang sudah terinput sebelumnya: Rp. {{ $totalRealisasi }}</p>
                </div>
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button spinner type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container-no-overflow>
