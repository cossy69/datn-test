<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItineraryFeedbackResource\Pages;
use App\Filament\Resources\ItineraryFeedbackResource\RelationManagers;
use App\Models\ItineraryFeedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItineraryFeedbackResource extends Resource
{
    protected static ?string $model = ItineraryFeedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
        Forms\Components\Select::make('trip_id')->relationship('trip', 'destination_name')->required(),
        Forms\Components\TextInput::make('rating')->numeric()->required(),
        Forms\Components\Textarea::make('user_note'),
    ]);
}
public static function table(Table $table): Table {
    return $table->columns([
        Tables\Columns\TextColumn::make('trip.destination_name')->label('chuyến đi'),
        Tables\Columns\TextColumn::make('rating')->numeric(),
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
            'index' => Pages\ListItineraryFeedback::route('/'),
            'create' => Pages\CreateItineraryFeedback::route('/create'),
            'edit' => Pages\EditItineraryFeedback::route('/{record}/edit'),
        ];
    }
}