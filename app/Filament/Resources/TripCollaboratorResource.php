<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripCollaboratorResource\Pages;
use App\Filament\Resources\TripCollaboratorResource\RelationManagers;
use App\Models\TripCollaborator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripCollaboratorResource extends Resource
{
    protected static ?string $model = TripCollaborator::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
        Forms\Components\Select::make('trip_id')->relationship('trip', 'destination_name')->required(),
        Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
        Forms\Components\TextInput::make('role')->required()->default('viewer'),
    ]);
}
public static function table(Table $table): Table {
    return $table->columns([
        Tables\Columns\TextColumn::make('trip.destination_name'),
        Tables\Columns\TextColumn::make('user.name'),
        Tables\Columns\TextColumn::make('role'),
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
            'index' => Pages\ListTripCollaborators::route('/'),
            'create' => Pages\CreateTripCollaborator::route('/create'),
            'edit' => Pages\EditTripCollaborator::route('/{record}/edit'),
        ];
    }
}