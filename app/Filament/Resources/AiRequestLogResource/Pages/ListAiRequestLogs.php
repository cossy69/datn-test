<?php

namespace App\Filament\Resources\AiRequestLogResource\Pages;

use App\Filament\Resources\AiRequestLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAiRequestLogs extends ListRecords
{
    protected static string $resource = AiRequestLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
