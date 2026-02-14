<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTypeResource\Pages;
use App\Filament\Resources\ProductTypeResource\RelationManagers;
use App\Models\ProductType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Products;

class ProductTypeResource extends Resource
{
    protected static ?string $model = ProductType::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('products_count')
                    ->counts('products')
                    ->label('Products'),
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
            'index' => Pages\ListProductTypes::route('/'),
            'create' => Pages\CreateProductType::route('/create'),
            'edit' => Pages\EditProductType::route('/{record}/edit'),
        ];
    }
}
