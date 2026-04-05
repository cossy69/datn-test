<?php

namespace App\Filament\Resources\TransitReferenceResource\Pages;

use App\Filament\Resources\TransitReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransitReferences extends ListRecords
{
    protected static string $resource = TransitReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
