<?php

namespace App\Filament\Resources\TripResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class tripstats extends BaseWidget
{
    protected function getStats(): array
{
return [
\Filament\Widgets\StatsOverviewWidget\Stat::make('tổng số chuyến đi', \App\Models\Trip::count()),
];
}
}