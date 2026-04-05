<?php

namespace App\Filament\Resources\WeatherAlertResource\Pages;

use App\Filament\Resources\WeatherAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeatherAlert extends EditRecord
{
    protected static string $resource = WeatherAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
