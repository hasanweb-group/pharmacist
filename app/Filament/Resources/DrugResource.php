<?php

namespace App\Filament\Resources;

use App\Enums\Localization;
use App\Filament\Resources\DrugResource\Pages;
use App\Filament\Resources\DrugResource\RelationManagers;
use App\Models\Drug;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DrugResource extends Resource
{
    protected static ?string $model = Drug::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralModelLabel(): string
    {
        return __(Localization::Drug->value . '.title');
    }

    public static function getModelLabel(): string
    {
        return __(Localization::Drug->value . '.drug');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label(Localization::Drug->value . '.name')
                    ->translateLabel()
                    ->maxLength(255),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->label(Localization::Drug->value . '.quantity')
                    ->translateLabel()
                    ->minValue(0),
                Textarea::make('description')
                    ->required()
                    ->label(Localization::Drug->value . '.description')
                    ->translateLabel()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('name')
                    ->label(Localization::Drug->value . '.name')
                    ->translateLabel()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(Localization::Drug->value . '.description')
                    ->translateLabel()
                    ->limit(50),
                TextColumn::make('quantity')
                    ->label(Localization::Drug->value . '.quantity')
                    ->translateLabel()
                    ->sortable(),
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
            'index' => Pages\ListDrugs::route('/'),
            'create' => Pages\CreateDrug::route('/create'),
            'edit' => Pages\EditDrug::route('/{record}/edit'),
        ];
    }
}
