<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Sub Rincian Objek Belanja
    </h2>
</x-slot>

<x-container>
    <div class="border-b pb-2 mb-6">
        <div class="border-l-8 border-l-blue-700 ">
            <h4 class="font-semibold pl-2">
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
            </h4>
            <div class="border-l-8 border-l-orange-500">
                <h4 class="font-semibold pl-2">
                    {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->kode ?? "" }}
                    {{$rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->nama ?? ""}}
                </h4>
                <div class="border-l-8 border-l-green-600">
                    <h4 class="font-semibold pl-2">
                        {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kode ?? "" }}
                        {{$rincianObjekBelanja->objekBelanja->jenisBelanja->nama ?? "" }}
                    </h4>
                    <div class="border-l-8 border-l-indigo-600">
                        <h4 class="font-semibold pl-2">
                            {{ $rincianObjekBelanja->objekBelanja->kode ?? "" }}
                            {{ $rincianObjekBelanja->objekBelanja->nama ?? "" }}
                        </h4>
                        <div class="border-l-8 border-l-gray-500">
                            <h4 class="font-semibold pl-2">
                                {{ $rincianObjekBelanja->kode ?? "" }}
                                {{ $rincianObjekBelanja->nama ?? "" }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <x-input label="Kode Sub Rincian Objek Belanja" wire:model.defer="subRincianObjekBelanja.kode"
                placeholder="Kode Sub Rincian Objek Belanja" />
            <x-input label="Nama Sub Rincian Objek Belanja" wire:model.defer="subRincianObjekBelanja.nama"
                placeholder="Nama Sub Rincian Objek Belanja" />
            <div class="flex justify-between">
                <x-button gray label="Kembali" href="{{ url()->previous() }}" />
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>