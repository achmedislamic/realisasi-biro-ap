<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Sub Rincian Objek Belanja
    </h2>
</x-slot>

<x-container>
    <div class="border-l-2 border-slate-900 text-slate-900 mb-4 bg-slate-100 py-2">
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-2 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->akunBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-4 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kelompokBelanja->nama ??"" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-8 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->jenisBelanja->kode ?? "" }}
                {{$rincianObjekBelanja->objekBelanja->jenisBelanja->nama ?? ""}}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-10 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->objekBelanja->kode ?? "" }}
                {{ $rincianObjekBelanja->objekBelanja->nama ?? "" }}
            </p>
        </div>
        <div class="flex gap-x-1 items-center">
            <div class="bg-slate-900 w-12 h-0.5"></div>
            <p>
                {{ $rincianObjekBelanja->kode ?? "" }}
                {{$rincianObjekBelanja->nama ?? "" }}
            </p>
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