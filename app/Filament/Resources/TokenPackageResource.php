<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokenPackageResource\Pages;
use App\Filament\Resources\TokenPackageResource\RelationManagers;
use App\Models\TokenPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TokenPackageResource extends Resource
{
    protected static ?string $model = TokenPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\TextInput::make('name')->required(),
        Forms\Components\TextInput::make('token_amount')->numeric()->required(),
        Forms\Components\TextInput::make('price')->numeric()->required(),
        Forms\Components\Toggle::make('is_active')->default(true),
    ]);
}

public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('name'),
        Tables\Columns\TextColumn::make('token_amount')->numeric(),
        Tables\Columns\TextColumn::make('price')->money('VND'),
        Tables\Columns\IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ListTokenPackages::route('/'),
            'create' => Pages\CreateTokenPackage::route('/create'),
            'edit' => Pages\EditTokenPackage::route('/{record}/edit'),
        ];
    }
}