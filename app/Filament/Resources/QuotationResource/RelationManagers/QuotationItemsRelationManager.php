<?php

namespace App\Filament\Resources\QuotationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuotationItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'id')
                    ->getOptionLabelFromRecordUsing(function (\App\Models\Product $record) {
                        return $record->type->name . ' - ' . $record->brand->name . ' (' . $record->capacity . ')';
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(50)
                    ->default('pcs'),
                Forms\Components\TextInput::make('unit_price')
                    ->disabled()
                    ->numeric()
                    ->step(0.01)
                    ->prefix('₱')
                    ->dehydrated(false),
                Forms\Components\TextInput::make('amount')
                    ->disabled()
                    ->numeric()
                    ->prefix('₱'),
            ]);
    }

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->recordTitleAttribute('item_description')
    //         ->columns([
    //             Tables\Columns\TextColumn::make('item_description')
    //                 ->label('Item Description')
    //                 ->getStateUsing(fn ($record) => $record->getItemDescriptionAttribute()),
    //             Tables\Columns\TextColumn::make('quantity')
    //                 ->numeric(),
    //             Tables\Columns\TextColumn::make('unit'),
    //             Tables\Columns\TextColumn::make('unit_price')
    //                 ->money('PHP')
    //                 ->label('Unit Price'),
    //             Tables\Columns\TextColumn::make('amount')
    //                 ->money('PHP')
    //                 ->label('Amount'),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->headerActions([
    //             // Tables\Actions\CreateAction::make(),
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //             Tables\Actions\DeleteAction::make(),
    //         ])
    //         ->bulkActions([
    //             // Tables\Actions\BulkActionGroup::make([
    //             //     Tables\Actions\DeleteBulkAction::make(),
    //             // ]),
    //         ]);
    // }
}
