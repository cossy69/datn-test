<?php

namespace App\Filament\Resources\TripCollaboratorResource\Pages;

use App\Filament\Resources\TripCollaboratorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTripCollaborators extends ListRecords
{
    protected static string $resource = TripCollaboratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
