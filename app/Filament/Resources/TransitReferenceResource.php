<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransitReferenceResource\Pages;
use App\Filament\Resources\TransitReferenceResource\RelationManagers;
use App\Models\TransitReference;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransitReferenceResource extends Resource
{
    protected static ?string $model = TransitReference::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table {
    return $table->columns([
        Tables\Columns\TextColumn::make('trip.destination_name'),
        Tables\Columns\TextColumn::make('provider'),
        Tables\Columns\TextColumn::make('estimated_price')->money('VND'),
        Tables\Columns\TextColumn::make('fetched_at')->dateTime(),
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
            'index' => Pages\ListTransitReferences::route('/'),
            'create' => Pages\CreateTransitReference::route('/create'),
            'edit' => Pages\EditTransitReference::route('/{record}/edit'),
        ];
    }
}