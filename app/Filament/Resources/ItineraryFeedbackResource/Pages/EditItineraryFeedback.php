<?php

namespace App\Filament\Resources\ItineraryFeedbackResource\Pages;

use App\Filament\Resources\ItineraryFeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItineraryFeedback extends EditRecord
{
    protected static string $resource = ItineraryFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
