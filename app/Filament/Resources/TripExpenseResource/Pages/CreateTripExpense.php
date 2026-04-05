<?php

namespace App\Filament\Resources\TripExpenseResource\Pages;

use App\Filament\Resources\TripExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTripExpense extends CreateRecord
{
    protected static string $resource = TripExpenseResource::class;
}
