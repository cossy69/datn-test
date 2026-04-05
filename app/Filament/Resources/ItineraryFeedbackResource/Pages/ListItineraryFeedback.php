<?php

namespace App\Filament\Resources\ItineraryFeedbackResource\Pages;

use App\Filament\Resources\ItineraryFeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItineraryFeedback extends ListRecords
{
    protected static string $resource = ItineraryFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
