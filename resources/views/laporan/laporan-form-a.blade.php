@extends('layouts.app2')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Laporan Form A
</h2>
@endsection

@section('content')
<div class="pb-12">
    <div class="bg-white shadow-sm sm:rounded-lg overflow-clip">
        <div class="bg-utama text-white p-4 font-bold tracking-wider">
            <h2 class="text-center">
                LAPORAN BULANAN PELAKSANAAN PROGRAM/KEGIATAN DOKUMEN PELAKSANAAN KEGIATAN ANGGARAN APBD PROVINSI NTB
            </h2>
            <H2 class="text-center">
                TAHUN ANGGARAN ...
            </H2>
        </div>

        <div class="p-6 text-gray-900">
            <form action="{{ route('laporan-form-a.export') }}" method="POST">
                @csrf
                <div class="flex flex-col space-y-3 pb-4">

                    @livewire('laporan.laporan-form-a')

                    <div class="w-full flex justify-end gap-4">
                        <x-button type="submit" green label="Download Laporan" />
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection