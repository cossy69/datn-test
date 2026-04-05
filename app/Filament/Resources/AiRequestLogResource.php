<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AiRequestLogResource\Pages;
use App\Filament\Resources\AiRequestLogResource\RelationManagers;
use App\Models\AiRequestLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AiRequestLogResource extends Resource
{
    protected static ?string $model = AiRequestLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('user.name'),
        Tables\Columns\TextColumn::make('action_type'),
        Tables\Columns\TextColumn::make('tokens_consumed')->numeric(),
        Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListAiRequestLogs::route('/'),
            'create' => Pages\CreateAiRequestLog::route('/create'),
            'edit' => Pages\EditAiRequestLog::route('/{record}/edit'),
        ];
    }
}