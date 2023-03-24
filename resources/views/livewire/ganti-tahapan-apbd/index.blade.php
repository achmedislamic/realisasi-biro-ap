<div class="flex justify-end">
    <button wire:click="$emit('openModal', 'ganti-tahapan-apbd.ganti-tahapan-apbd-modal')" class="font-bold text-xl">
        {{ $tahapanApbd->tahun}}
        {{ $tahapanApbd->nama }}
    </button>
</div>