<?php

namespace App\Filament\Resources\TripExpenseResource\Pages;

use App\Filament\Resources\TripExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTripExpense extends EditRecord
{
    protected static string $resource = TripExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
