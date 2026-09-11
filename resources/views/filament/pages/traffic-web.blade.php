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
        @php($max = $trend ? max(array_column($trend, 'count')) : 1)
        <div style="display:flex; align-items:flex-end; gap:6px; height:13rem; padding-top:0.5rem;">
            @foreach ($trend as $point)
                @php($h = (int) round(($point['count'] / $max) * 100))
                <div
                    title="{{ $point['label'] }}: {{ $point['count'] }} kunjungan"
                    style="flex:1 1 0%; max-width:36px; min-height:3px; height:{{ $h }}%; {{ $h > 0 ? 'background:#FFC72C; opacity:0.82;' : 'background:rgba(255,199,44,0.25);' }} border-radius:6px 6px 0 0;"
                ></div>
            @endforeach
        </div>
        <div style="display:flex; gap:6px; margin-top:8px; border-top:1px solid rgba(156,163,175,0.35); padding-top:6px;">
            @foreach ($trend as $point)
                <div style="flex:1 1 0%; text-align:center; font-size:10px; line-height:12px; color:#7A8699;">{{ $point['label'] }}</div>
            @endforeach
        </div>
    </x-filament::section>

    <x-filament::section icon="heroicon-o-list-bullet" heading="Rincian Kunjungan" icon-color="primary">
        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>