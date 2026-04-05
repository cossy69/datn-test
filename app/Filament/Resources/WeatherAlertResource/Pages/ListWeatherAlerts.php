<?php

namespace App\Filament\Resources\WeatherAlertResource\Pages;

use App\Filament\Resources\WeatherAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeatherAlerts extends ListRecords
{
    protected static string $resource = WeatherAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
