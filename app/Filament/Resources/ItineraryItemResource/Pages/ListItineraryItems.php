<?php

namespace App\Filament\Resources\ItineraryItemResource\Pages;

use App\Filament\Resources\ItineraryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItineraryItems extends ListRecords
{
    protected static string $resource = ItineraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
