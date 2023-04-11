<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow-lg max-w-3xl rounded-xl overflow-clip p-6 w-full h-96">

        <h1 class="font-bold tracking-widest text-2xl">DASHBOARD REALISASI</h1>
        <h3 class="font-bold tracking-widest text-XL mb-8">BIRO-AP</h3>

        <div class="flex flex-wrap gap-4 justify-center mb-5 max-h-60 overflow-y-scroll hide-scrollbar p-2">
            @foreach ($tahunAnggarans as $ta)
            <div class="flex flex-col items-center justify-center rounded-md gap-1 hover:shadow-lg hover:bg-utama hover:text-white transition duration-150 h-20 w-20 cursor-pointer"
                wire:click="pilihTahunAnggaran({{ $ta->id }})">
                <x-icon name="database" class="w-10 h-10" />
                <h2 class="font-bold tracking-wider w-full text-center">{{ $ta->tahun }}</h2>
            </div>
            @endforeach
        </div>
    </div>
</div>