<?php

namespace App\Filament\Resources\TripAccommodationResource\Pages;

use App\Filament\Resources\TripAccommodationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTripAccommodations extends ListRecords
{
    protected static string $resource = TripAccommodationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
