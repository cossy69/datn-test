<?php

namespace App\Filament\Resources\TripAccommodationResource\Pages;

use App\Filament\Resources\TripAccommodationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripAccommodation extends EditRecord
{
    protected static string $resource = TripAccommodationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
