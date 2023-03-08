<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Bidang Urusan
    </h2>
</x-slot>

<x-container>
    <div class="bg-orange-300 mb-6 px-4 py-1">
        <div class="flex justify-between">
            <h4 class="font-semibold">{{ $urusan->nama }}</h4>
            <x-button.circle white xs icon="folder-open" :href="route('perangkat-daerah')" />
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Nama Bidang Urusan" wire:model.defer="bidangUrusan.nama" placeholder="Nama bidang urusan" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>