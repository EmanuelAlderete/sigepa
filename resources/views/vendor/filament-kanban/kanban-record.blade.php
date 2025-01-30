<div id="{{ $record->getKey() }}" wire:click="recordClicked('{{ $record->getKey() }}', {{ @json_encode($record) }})"
    class="record bg-white dark:bg-gray-700 rounded-lg px-4 py-2 cursor-grab font-medium text-gray-600 dark:text-gray-200"
    @if ($record->timestamps && now()->diffInSeconds($record->{$record::UPDATED_AT}) < 3) x-data
        x-init="
            $el.classList.add('animate-pulse-twice', 'bg-primary-100', 'dark:bg-primary-800')
            $el.classList.remove('bg-white', 'dark:bg-gray-700')
            setTimeout(() => {
                $el.classList.remove('bg-primary-100', 'dark:bg-primary-800')
                $el.classList.add('bg-white', 'dark:bg-gray-700')
            }, 3000)
        " @endif>


    {{ $record->{static::$recordTitleAttribute} }}
    <div class="mt-3 flex">

        <x-filament::badge icon-position="after" color="warning">
            {{ $record->category }}
        </x-filament::badge>

        @switch($record->priority)
            @case('baixa')
                <x-filament::badge icon-position="after" color="gray">
                    Prioridade {{ $record->priority }}
                </x-filament::badge>
            @break
            @case('média')
                <x-filament::badge icon-position="after" color="warning">
                    Prioridade {{ $record->priority }}
                </x-filament::badge>
            @break
            @case('alta')
                <x-filament::badge icon-position="after" color="danger">
                    Prioridade {{ $record->priority }}
                </x-filament::badge>
            @break

            @default
        @endswitch



    </div>
</div>
