<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SavedTranslationResource\Pages;
use App\Filament\Resources\SavedTranslationResource\RelationManagers;
use App\Models\SavedTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SavedTranslationResource extends Resource
{
    protected static ?string $model = SavedTranslation::class;

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
        Tables\Columns\TextColumn::make('user.name'),
        Tables\Columns\TextColumn::make('trip.destination_name'),
        Tables\Columns\TextColumn::make('language'),
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
            'index' => Pages\ListSavedTranslations::route('/'),
            'create' => Pages\CreateSavedTranslation::route('/create'),
            'edit' => Pages\EditSavedTranslation::route('/{record}/edit'),
        ];
    }
}