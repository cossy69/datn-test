<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItineraryItemResource\Pages;
use App\Filament\Resources\ItineraryItemResource\RelationManagers;
use App\Models\ItineraryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItineraryItemResource extends Resource
{
    protected static ?string $model = ItineraryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('trip_day_id')->relationship('tripDay', 'id')->required(),
        Forms\Components\Select::make('location_id')->relationship('location', 'name')->required(),
        Forms\Components\TimePicker::make('start_time')->required(),
        Forms\Components\TimePicker::make('end_time')->required(),
        Forms\Components\TextInput::make('estimated_cost')->numeric(),
        Forms\Components\Toggle::make('is_locked'),
    ]);
}

public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('tripDay.trip.destination_name')->label('Chuyến đi'),
        Tables\Columns\TextColumn::make('location.name')->label('Địa điểm'),
        Tables\Columns\TextColumn::make('start_time')->time(),
        Tables\Columns\IconColumn::make('is_locked')->boolean(),
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
            'index' => Pages\ListItineraryItems::route('/'),
            'create' => Pages\CreateItineraryItem::route('/create'),
            'edit' => Pages\EditItineraryItem::route('/{record}/edit'),
        ];
    }
}