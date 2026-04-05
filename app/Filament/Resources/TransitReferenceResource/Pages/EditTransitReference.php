<?php

namespace App\Filament\Resources\TransitReferenceResource\Pages;

use App\Filament\Resources\TransitReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransitReference extends EditRecord
{
    protected static string $resource = TransitReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
