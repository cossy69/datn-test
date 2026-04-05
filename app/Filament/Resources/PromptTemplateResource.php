<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromptTemplateResource\Pages;
use App\Filament\Resources\PromptTemplateResource\RelationManagers;
use App\Models\PromptTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromptTemplateResource extends Resource
{
    protected static ?string $model = PromptTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
        Forms\Components\TextInput::make('name')->required(),
        Forms\Components\Textarea::make('system_instruction')->required(),
        Forms\Components\Textarea::make('user_template')->required(),
        Forms\Components\TextInput::make('version')->required(),
        Forms\Components\Toggle::make('is_active')->default(true),
    ]);
}
public static function table(Table $table): Table {
    return $table->columns([
        Tables\Columns\TextColumn::make('name'),
        Tables\Columns\TextColumn::make('version'),
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
            'index' => Pages\ListPromptTemplates::route('/'),
            'create' => Pages\CreatePromptTemplate::route('/create'),
            'edit' => Pages\EditPromptTemplate::route('/{record}/edit'),
        ];
    }
}