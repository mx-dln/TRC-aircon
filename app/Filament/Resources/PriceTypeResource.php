<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PriceType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Products;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PriceTypeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PriceTypeResource\RelationManagers;

class PriceTypeResource extends Resource
{
    protected static ?string $model = PriceType::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = Products::class;
    
    protected static ?string $navigationLabel = 'Pricing Types';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('code')
                ->required()
                ->unique(ignoreRecord: true)
                ->disabled(fn ($record) => $record !== null),

            Forms\Components\TextInput::make('label')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('label'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPriceTypes::route('/'),
            'create' => Pages\CreatePriceType::route('/create'),
            'edit' => Pages\EditPriceType::route('/{record}/edit'),
        ];
    }
}
