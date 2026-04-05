<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
return $form->schema([
Forms\Components\TextInput::make('destination_name')->required(),
Forms\Components\DatePicker::make('start_date'),
Forms\Components\Select::make('status')->options([
'planning' => 'lên kế hoạch',
'completed' => 'đã xong'
])
]);
}

    public static function table(Table $table): Table
{
return $table->columns([
Tables\Columns\TextColumn::make('destination_name'),
Tables\Columns\TextColumn::make('start_date')->date(),
Tables\Columns\TextColumn::make('status')->badge(),
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}