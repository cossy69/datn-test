<?php

namespace App\Filament\Resources\ItineraryItemResource\Pages;

use App\Filament\Resources\ItineraryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItineraryItem extends EditRecord
{
    protected static string $resource = ItineraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
