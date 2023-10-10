<div>
    @if ($showImportProgress)
    <div wire:poll.visible>
        <div class="bg-blue-200 p-4 rounded-md border-2 border-blue-600 mb-4 text-gray-900 w-full flex flex-col gap-2">
            <h4 class="font-semibold">Proses import sedang berlangsung, mohon tunggu.</h4>
            <div class="bg-red-500 p-2 text-white font-bold flex gap-x-2 items-center">
                <x-icon name="exclamation" class="w-5 h-5" />
                <h4>Jangan Refresh Halaman!</h4>
            </div>

            <div class="w-ful flex gap-x-2 items-center">
                <div class="bg-gray-100 w-full rounded-full">
                    <div class="bg-blue-600 rounded-full text-xs py-0.5 text-center text-white h-3"
                        style="width: {{ $percentage }}%">
                    </div>
                </div>
                <h4 class="w-14">{{ $percentage." %" }}</h4>
            </div>
        </div>
    </div>
    @endif

    @if ($importFinished)
    <div wire:poll.visible>
        <div class="bg-green-300 p-4 rounded-md border-2 border-green-600 mb-4 text-gray-900 w-full">
            <h4 class="font-semibold">Proses import selesai.</h4>
        </div>
    </div>
    @endif
</div>
