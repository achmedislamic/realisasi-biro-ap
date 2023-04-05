<div class="flex justify-end">
    @if (auth()->user()->isAdmin())
        <button wire:click="$emit('openModal', 'ganti-tahapan-apbd.ganti-tahapan-apbd-modal')" class="font-bold text-xl">
            {{ $tahapanApbd->tahun}}
            {{ $tahapanApbd->nama }}
        </button>
    @else
        <div class="font-bold text-xl">
            {{ $tahapanApbd->tahun}}
            {{ $tahapanApbd->nama }}
        </div>
    @endif

</div>
