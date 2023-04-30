<div>
    <x-modal.card max-width="w-full" title="Sub OPD" blur wire:model.defer="modal">
        <x-card :fullscreen="true" cardClasses="overflow-x-auto w-full">
            <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                <x-dashboard.thead :$colspanRealisasi :$periode :$foreachCount />
                <tbody>
                    <x-dashboard.sub-opd-foreach :$subOpds :$periode :$targetSubOpds :$foreachCount />
                </tbody>
            </table>
        </x-card>

    </x-modal.card>
</div>
