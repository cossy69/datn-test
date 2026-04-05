<?php

namespace App\Filament\Resources\TripDaysResource\Pages;

use App\Filament\Resources\TripDaysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripDays extends EditRecord
{
    protected static string $resource = TripDaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
