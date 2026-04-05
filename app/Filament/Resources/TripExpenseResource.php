<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripExpenseResource\Pages;
use App\Filament\Resources\TripExpenseResource\RelationManagers;
use App\Models\TripExpense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripExpenseResource extends Resource
{
    protected static ?string $model = TripExpense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('trip_id')->relationship('trip', 'destination_name')->required(),
        Forms\Components\TextInput::make('category')->required(),
        Forms\Components\TextInput::make('planned_amount')->numeric()->required(),
        Forms\Components\TextInput::make('actual_amount')->numeric(),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTripExpenses::route('/'),
            'create' => Pages\CreateTripExpense::route('/create'),
            'edit' => Pages\EditTripExpense::route('/{record}/edit'),
        ];
    }
}