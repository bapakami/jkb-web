<?php

namespace App\Filament\Resources\TahukahAndaResource\Pages;

use App\Filament\Resources\TahukahAndaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTahukahAndas extends ListRecords
{
    protected static string $resource = TahukahAndaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
