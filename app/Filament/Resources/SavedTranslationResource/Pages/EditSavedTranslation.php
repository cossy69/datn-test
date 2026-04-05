<?php

namespace App\Filament\Resources\SavedTranslationResource\Pages;

use App\Filament\Resources\SavedTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSavedTranslation extends EditRecord
{
    protected static string $resource = SavedTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
