@props(['model', 'isPaginated' => true])
<div class="flex flex-col space-y-3 overflow-auto">
    <div class="flex flex-row justify-between mb-3 p-1">
        <div>
            @isset($table_actions)
                {{ $table_actions }}
            @else
                <x-button primary :href="route('pengguna.form')" label="Tambah" />
            @endisset
        </div>

        <div class="w-1/2">
            <x-input icon="search" placeholder="Cari" wire:model="cari" type="search" id="table-search" />
        </div>

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
