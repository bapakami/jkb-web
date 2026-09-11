<x-filament-panels::page>
    <x-filament::section icon="heroicon-o-funnel" heading="Filter" icon-color="primary">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {{ $this->form }}
        </div>
    </x-filament::section>

    <div class="grid gap-4 sm:grid-cols-3">
        <x-filament::section icon="heroicon-o-eye" heading="Total Kunjungan" icon-color="primary">
            <p class="text-3xl font-bold tracking-tight text-gray-950 dark:text-white">{{ number_format($total) }}</p>
        </x-filament::section>

        <x-filament::section icon="heroicon-o-users" heading="Pengunjung Unik" icon-color="success">
            <p class="text-3xl font-bold tracking-tight text-gray-950 dark:text-white">{{ number_format($unique) }}</p>
        </x-filament::section>

        <x-filament::section icon="heroicon-o-fire" heading="Halaman Terpopuler" icon-color="warning">
            @if ($top->isNotEmpty())
                <p class="text-xl font-bold tracking-tight text-gray-950 dark:text-white">{{ $top->first()->url }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ number_format((int) $top->first()->total) }} kunjungan</p>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data.</p>
            @endif
        </x-filament::section>
    </div>

    <x-filament::section icon="heroicon-o-chart-bar" heading="Tren Kunjungan Harian" icon-color="primary">
        @if ($trend)
            @php($max = max(array_column($trend, 'count')) ?: 1)
            <div class="flex h-56 items-end gap-1.5">
                @foreach ($trend as $point)
                    <div class="flex h-full flex-1 flex-col items-center justify-end">
                        <div
                            class="w-full max-w-[32px] rounded-t bg-primary-500/70 transition hover:bg-primary-500"
                            style="height: {{ (int) round(($point['count'] / $max) * 100) }}%"
                            title="{{ $point['label'] }}: {{ $point['count'] }} kunjungan"
                        ></div>
                    </div>
                @endforeach
            </div>
            <div class="mt-2 flex gap-1.5">
                @foreach ($trend as $point)
                    <div class="flex-1 text-center text-[10px] leading-3 text-gray-400">{{ $point['label'] }}</div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data kunjungan.</p>
        @endif
    </x-filament::section>

    <x-filament::section icon="heroicon-o-list-bullet" heading="Rincian Kunjungan" icon-color="primary">
        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>