<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripAccommodationResource\Pages;
use App\Filament\Resources\TripAccommodationResource\RelationManagers;
use App\Models\TripAccommodation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripAccommodationResource extends Resource
{
    protected static ?string $model = TripAccommodation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
        Forms\Components\Select::make('trip_id')->relationship('trip', 'destination_name')->required(),
        Forms\Components\Select::make('location_id')->relationship('location', 'name')->required(),
        Forms\Components\DateTimePicker::make('check_in_time')->required(),
        Forms\Components\DateTimePicker::make('check_out_time')->required(),
        Forms\Components\TextInput::make('booking_ref'),
    ]);
}
public static function table(Table $table): Table {
    return $table->columns([
        Tables\Columns\TextColumn::make('trip.destination_name'),
        Tables\Columns\TextColumn::make('location.name'),
        Tables\Columns\TextColumn::make('check_in_time')->dateTime(),
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
            'index' => Pages\ListTripAccommodations::route('/'),
            'create' => Pages\CreateTripAccommodation::route('/create'),
            'edit' => Pages\EditTripAccommodation::route('/{record}/edit'),
        ];
    }
}