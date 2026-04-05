<?php

namespace App\Filament\Resources\SavedTranslationResource\Pages;

use App\Filament\Resources\SavedTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSavedTranslations extends ListRecords
{
    protected static string $resource = SavedTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
