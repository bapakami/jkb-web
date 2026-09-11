<?php

namespace App\Filament\Pages;

use App\Models\PageVisit;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TrafficWeb extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Analitik';

    protected static ?string $navigationLabel = 'Traffic Website';

    protected static ?string $title = 'Traffic Website';

    protected ?string $subheading = 'Rekap kunjungan ke halaman publik';

    protected static ?string $slug = 'traffic-web';

    protected static string $view = 'filament.pages.traffic-web';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'range' => '7',
            'from' => null,
            'to' => null,
            'url' => null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('range')
                    ->label('Rentang Tanggal')
                    ->options([
                        'today' => 'Hari ini',
                        '7' => '7 hari terakhir',
                        '30' => '30 hari terakhir',
                        'custom' => 'Kustom',
                    ])
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state): void {
                        $set('from', null);
                        $set('to', null);
                    }),
                DatePicker::make('from')
                    ->label('Dari')
                    ->live()
                    ->visible(fn (Get $get): bool => $get('range') === 'custom'),
                DatePicker::make('to')
                    ->label('Sampai')
                    ->live()
                    ->visible(fn (Get $get): bool => $get('range') === 'custom'),
                Select::make('url')
                    ->label('Halaman')
                    ->placeholder('Semua halaman')
                    ->options(fn (): array => PageVisit::query()
                        ->select('url')
                        ->distinct()
                        ->orderBy('url')
                        ->pluck('url', 'url')
                        ->all())
                    ->searchable()
                    ->live(),
            ])
            ->columns(4);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => $this->baseQuery())
            ->defaultSort('visited_at', 'desc')
            ->columns([
                TextColumn::make('url')
                    ->label('Halaman')
                    ->wrap()
                    ->limit(80)
                    ->tooltip(fn (string $state): string => $state),
                TextColumn::make('visited_at')
                    ->label('Waktu Kunjungan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('user_agent')
                    ->label('User Agent')
                    ->limit(60)
                    ->tooltip(fn (string $state): string => $state),
            ])
            ->paginated([15, 25, 50, 100])
            ->defaultPaginationPageOption(15)
            ->emptyStateIcon('heroicon-o-eye-slash')
            ->emptyStateHeading('Belum ada data kunjungan')
            ->emptyStateDescription('Kunjungan ke halaman publik akan tercatat otomatis mulai sekarang; data tampil di sini setelah ada pengunjung.');
    }

    protected function getViewData(): array
    {
        $base = $this->baseQuery();

        $total = (clone $base)->count();

        $unique = (clone $base)
            ->distinct()
            ->count('ip_address');

        $top = (clone $base)
            ->selectRaw('url, COUNT(*) AS total')
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'total' => $total,
            'unique' => $unique,
            'top' => $top,
            'trend' => $this->trendData(),
        ];
    }

    private function dateRange(): array
    {
        $range = $this->data['range'] ?? '7';
        $from = null;
        $to = null;

        if ($range === 'today') {
            $from = now()->startOfDay();
            $to = now()->endOfDay();
        } elseif ($range === 'custom') {
            if (! empty($this->data['from'])) {
                $from = Carbon::parse($this->data['from'])->startOfDay();
            }
            if (! empty($this->data['to'])) {
                $to = Carbon::parse($this->data['to'])->endOfDay();
            }
        } else {
            $from = now()->subDays((int) $range)->startOfDay();
            $to = now()->endOfDay();
        }

        return [$from, $to];
    }

    private function baseQuery(): Builder
    {
        [$from, $to] = $this->dateRange();

        $query = PageVisit::query();

        if ($from) {
            $query->where('visited_at', '>=', $from);
        }

        if ($to) {
            $query->where('visited_at', '<=', $to);
        }

        if (! empty($this->data['url'])) {
            $query->where('url', $this->data['url']);
        }

        return $query;
    }

    private function trendData(): array
    {
        [$from, $to] = $this->dateRange();
        $from ??= now()->subDays(6)->startOfDay();
        $to ??= now()->endOfDay();

        $rows = (clone $this->baseQuery())
            ->selectRaw('DATE(visited_at) AS day, COUNT(*) AS total')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->pluck('total', 'day');

        $points = [];

        for ($day = $from->copy(); $day->lte($to); $day->addDay()) {
            $points[] = [
                'label' => $day->format('d M'),
                'count' => (int) ($rows[$day->format('Y-m-d')] ?? 0),
            ];
        }

        return $points;
    }
}