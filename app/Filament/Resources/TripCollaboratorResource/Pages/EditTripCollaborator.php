<?php

namespace App\Filament\Resources\TripCollaboratorResource\Pages;

use App\Filament\Resources\TripCollaboratorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripCollaborator extends EditRecord
{
    protected static string $resource = TripCollaboratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
