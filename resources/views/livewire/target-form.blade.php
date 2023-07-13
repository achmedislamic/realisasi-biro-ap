<x-slot:header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Form Target {{ $subOpd->teks_lengkap }}
    </h2>
</x-slot:header>

<x-container>
    <form wire:submit.prevent="simpan">
        <div class="flex flex-col space-y-3 px-16">

            @foreach ($bulans as $bulan)
                <div class="flex flex-row space-x-3 px-16">
                    <div class="w-1/2">
                        <p>Bulan: {{ $bulan }}</p>
                    </div>
                    <div class="w-full">
                        <x-inputs.currency
                            label="Target"
                            hint="Jika angka memiliki desimal, gunakan tanda titik (.) sebagai pemisah"
                            wire:model.defer="targets.{{ $loop->index }}" />
                    </div>
                </div>
            @endforeach

            <div class="ml-auto">
                <x-button type="submit" positive label="Simpan" />
            </div>
        </div>
    </form>

</x-container>
