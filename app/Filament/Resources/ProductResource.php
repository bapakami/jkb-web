<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Katalog';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Kategori'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Kosongkan slug agar dibuat otomatis')
                            ->live()
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->maxLength(255)
                            ->label('Sub Judul'),
                        Forms\Components\Textarea::make('summary')
                            ->rows(3)
                            ->label('Ringkasan'),
                    ])->columns(2),
                Forms\Components\Section::make('Konten')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Lengkap'),
                        Forms\Components\RichEditor::make('uses')
                            ->label('Penggunaan'),
                    ]),
                Forms\Components\Section::make('Spesifikasi & Fitur')
                    ->schema([
                        Forms\Components\KeyValue::make('specifications')
                            ->keyLabel('Parameter')
                            ->valueLabel('Nilai')
                            ->addActionLabel('Tambah spesifikasi'),
                        Forms\Components\Repeater::make('features')
                            ->label('Fitur Unggulan')
                            ->schema([
                                Forms\Components\TextInput::make('fitur')
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Section::make('Gambar')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('products')
                            ->maxSize(4096)
                            ->label('Gambar Utama'),
                        Forms\Components\Repeater::make('gallery')
                            ->label('Galeri')
                            ->schema([
                                Forms\Components\FileUpload::make('gambar')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('products/gallery')
                                    ->maxSize(4096)
                                    ->disableLabel(),
                            ]),
                    ])->columns(2),
                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Unggulan (tampil di beranda)')
                            ->default(false),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Urutan'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')->rows(2),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Gambar'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Unggulan'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->label('Urutan'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Unggulan'),
                Tables\Filters\TernaryFilter::make('is_active')->label('Status'),
            ])
            ->searchPlaceholder('Cari produk...')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}