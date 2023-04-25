@props(['model', 'isPaginated' => true, 'searchable' => true])
<div class="flex flex-col space-y-3 overflow-auto">
    <div class="flex flex-row justify-between mb-3 p-1">
        <div>
            {{ $table_actions ?? '' }}
        </div>

        @if ($searchable)
            <div class="w-1/2">
                <x-input icon="search" placeholder="Cari" wire:model="cari" type="search" id="table-search" />
            </div>
        @endif
    </div>

    <table {{ $attributes->merge(['class' => 'w-full text-sm text-left text-gray-500 dark:text-gray-400']) }}>
        {{ $slot }}
    </table>

    @if ($isPaginated)
        <div>
            {{ $model->links() }}
        </div>
    @endif

</div>
