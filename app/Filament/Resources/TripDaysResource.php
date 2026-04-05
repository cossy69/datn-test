<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripDaysResource\Pages;
use App\Filament\Resources\TripDaysResource\RelationManagers;
use App\Models\TripDays;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripDaysResource extends Resource
{
    protected static ?string $model = TripDays::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('trip_id')
            ->relationship('trip', 'destination_name')
            ->required(),
        Forms\Components\TextInput::make('day_index')->numeric()->required(),
        Forms\Components\DatePicker::make('date')->required(),
    ]);
}

public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('trip.destination_name'),
        Tables\Columns\TextColumn::make('day_index')->sortable(),
        Tables\Columns\TextColumn::make('date')->date(),
    ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTripDays::route('/'),
            'create' => Pages\CreateTripDays::route('/create'),
            'edit' => Pages\EditTripDays::route('/{record}/edit'),
        ];
    }
}