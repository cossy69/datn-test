<?php

namespace App\Filament\Resources\TripExpenseResource\Pages;

use App\Filament\Resources\TripExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTripExpenses extends ListRecords
{
    protected static string $resource = TripExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
