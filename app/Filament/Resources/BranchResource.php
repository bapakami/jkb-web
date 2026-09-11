<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?string $navigationLabel = 'Cabang';

    protected static ?string $modelLabel = 'Cabang';

    protected static ?string $pluralModelLabel = 'Cabang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Cabang')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Cabang')
                            ->lazy()
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->options([
                                'Plant' => 'Plant / Pabrik',
                                'Cabang' => 'Cabang',
                                'Stockyard' => 'Stockyard',
                            ])
                            ->label('Tipe'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Urutan'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),
                Forms\Components\Section::make('Lokasi')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->rows(2)
                            ->label('Alamat'),
                        Forms\Components\TextInput::make('latitude'),
                        Forms\Components\TextInput::make('longitude'),
                        Forms\Components\TextInput::make('map_url')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Embed URL Google Maps (iframe src) — isi bila koordinat tidak tersedia'),
                    ])->columns(2),
                Forms\Components\Section::make('Kontak & Jam Operasional')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->maxLength(32)
                            ->label('Telepon'),
                        Forms\Components\TextInput::make('whatsapp')
                            ->maxLength(32)
                            ->label('WhatsApp'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(190)
                            ->label('Email'),
                        Forms\Components\TextInput::make('operational_hours')
                            ->maxLength(255)
                            ->label('Jam Operasional'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->label('Urutan'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}