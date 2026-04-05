<?php

namespace App\Filament\Resources\WeatherAlertResource\Pages;

use App\Filament\Resources\WeatherAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWeatherAlert extends CreateRecord
{
    protected static string $resource = WeatherAlertResource::class;
}
