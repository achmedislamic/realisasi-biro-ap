<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Data Anggaran
    </h2>
</x-slot>

<x-container>

    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3">
            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Urusan" wire:model="urusanPilihan">
                        <option selected>Pilih Urusan</option>
                        @foreach ($urusans as $urusan)
                            <option value="{{ $urusan->id }}">{{ $urusan->kode }} - {{ $urusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>

                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Bidang Urusan" wire:model.defer="bidangUrusanPilihan">
                        <option selected>Pilih Bidang Urusan</option>
                        @foreach ($bidangUrusans as $bidangUrusan)
                            <option value="{{ $bidangUrusan->id }}">{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-select
                        :disabled="auth()->user()->isNotAdmin()"
                        label="OPD"
                        placeholder="Pilih OPD"
                        wire:model="opdPilihan"
                        :async-data="route('select.opd')"
                        option-label="nama"
                        option-value="id"
                    />
                </div>

                <div class="w-full">
                    <x-native-select :disabled="auth()->user()->isNotAdmin()" label="Sub OPD" wire:model.defer="subOpdPilihan">
                        <option selected>Pilih Sub OPD (Unit)</option>
                        @foreach ($subOpds as $subOpd)
                            <option value="{{ $subOpd->id }}">{{ $subOpd->kode }} - {{ $subOpd->nama }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-full">
                    <x-form.select searchable required :disabled="auth()->user()->isNotAdmin()" label="Program" wire:model.defer="programPilihan">
                        <option selected>Pilih Program</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->kode }} - {{ $program->nama }}</option>
                        @endforeach
                    </x-form.select>
                </div>

                <div class="w-full">
                    <x-form.select searchable required :disabled="auth()->user()->isNotAdmin()" label="Kegiatan" wire:model.defer="kegiatanPilihan">
                        <option selected>Pilih Kegiatan</option>
                        @foreach ($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}">{{ $kegiatan->kode }} - {{ $kegiatan->nama }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <x-form.select searchable required :disabled="auth()->user()->isNotAdmin()" label="Sub Kegiatan" wire:model.defer="subKegiatanPilihan">
                <option selected>Pilih Sub Kegiatan</option>
                @foreach ($subKegiatans as $subKegiatan)
                    <option value="{{ $subKegiatan->id }}">{{ $subKegiatan->kode }} - {{ $subKegiatan->nama }}</option>
                @endforeach
            </x-form.select>

            <div class="w-full">
                <x-select
                    :disabled="auth()->user()->isNotAdmin()"
                    label="Rekening Belanja"
                    placeholder="Pilih Rekening Belanja (Sub Rincian Objek)"
                    wire:model.defer="rekeningBelanjaPilihan"
                    :async-data="route('select.sub-rincian-objek-belanja')"
                    option-label="nama"
                    option-value="id"
                />
            </div>

            <div class="w-full">
                <x-inputs.currency
                :disabled="auth()->user()->isNotAdmin()"
                                   label="Anggaran"
                                   hint="Jika angka memiliki desimal, gunakan tanda titik (.) sebagai pemisah"
                                   wire:model.defer="anggaran" />
            </div>

            <div class="flex flex-row space-x-3">
                <div class="w-full">
                    <x-inputs.currency
                                       label="Target Fisik"
                                       hint="Jika angka memiliki desimal, gunakan tanda titik (.) sebagai pemisah"
                                       wire:model.defer="target" />
                </div>

                <div class="w-full">
                    <x-native-select label="Satuan" wire:model.defer="satuanId">
                        <option value="">Silakan Pilih</option>
                        @foreach (App\Models\Satuan::all() as $satuan)
                            <option value="{{ $satuan->id }}">{{ str($satuan->nama)->title() }}</option>
                        @endforeach
                    </x-native-select>
                </div>
            </div>

            <div class="flex justify-between">
                <x-button gray label="Kembali ke halaman realisasi" :href="route('realisasi')" />
                <x-button spinner type="submit" positive label="{{ $submitText }}" />
            </div>
        </div>
    </form>

</x-container>

@pushOnce('styles')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>
@endPushOnce

@prependOnce('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@endPrependOnce
