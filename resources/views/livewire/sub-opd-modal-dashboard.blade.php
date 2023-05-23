<div>
    <x-modal.card max-width="w-full" title="Sub OPD" blur wire:model.defer="modal">
        <x-card :fullscreen="true">
            <div class="flex flex-col space-y-3">
                <h3 class="text-xl">{{ \App\Models\SubOpd::with('opd')->find($subOpds->first()?->id)?->opd?->teks_lengkap }}</h3>
                <div class="overflow-x-auto w-full">
                    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                        <x-dashboard.thead :$colspanRealisasi :$periode :$foreachCount :denganTarget="false" />
                        <tbody>
                            <x-table.tbody-dashboard :opds="$subOpds" :targetOpds="$targetSubOpds" :$periode :$foreachCount :denganTarget="false" />
                        </tbody>
                    </table>
                </div>
            </div>


        </x-card>

    </x-modal.card>
</div>
