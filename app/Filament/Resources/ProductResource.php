<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use App\Models\PriceType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Products;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->rules([
                        function ($get, $component) {
                            return function (string $attribute, $value, $fail) use ($get, $component) {
                                $record = $component->getRecord();
                                $exists = \App\Models\Product::query()
                                    ->where('brand_id', $value)
                                    ->where('product_type_id', $get('product_type_id'))
                                    ->where('capacity', $get('capacity'))
                                    ->when($record, function ($query) use ($record) {
                                        $query->where('id', '!=', $record->id);
                                    })
                                    ->exists();

                                if ($exists) {
                                    $fail('A product with this brand, type, and capacity already exists.');
                                }
                            };
                        },
                    ]),

                Forms\Components\Select::make('product_type_id')
                ->relationship('type', 'name')
                ->searchable()
                ->preload()
                ->required(),

                    Forms\Components\TextInput::make('capacity')
                ->required()
                ->placeholder('e.g. 1.0 HP'),
            ])
            ->columns(3),

            Forms\Components\FileUpload::make('image_path')
                ->disk('public')
                ->image()
                ->directory('products/images')
                ->visibility('public')
                ->preserveFilenames()
                ->nullable(),

            Repeater::make('prices')
                ->relationship()
                ->label('Pricing')
                ->schema([
                    Forms\Components\Hidden::make('price_type_id')
                        ->dehydrated()
                        ->default(function ($get, $operation, $record) {
                            // Assign correct PriceType based on repeater index
                            static $index = 0;
                            if ($operation === 'create') {
                                $priceType = PriceType::orderBy('id')->skip($index++)->first();
                                return $priceType ? $priceType->id : null;
                            }
                            return null;
                        })
                        ->afterStateHydrated(function (Forms\Set $set, $state, $record) {
                            if ($record?->priceType) {
                                $set('price_type_label', $record->priceType->label);
                            }
                        }),

                    Forms\Components\TextInput::make('price_type_label')
                        ->label('Price Type')
                        ->dehydrated(false)
                        ->default(function ($get, $operation, $record) {
                            // Assign correct PriceType based on repeater index
                            static $index = 0;
                            if ($operation === 'create') {
                                $priceType = PriceType::orderBy('id')->skip($index++)->first();
                                return $priceType ? $priceType->label : null;
                            }
                            return null;
                        })
                        ->disabled(),

                    Forms\Components\TextInput::make('price')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hint('If none, set it to 0')
                        ->numeric()
                        ->prefix('₱')
                        ->required(),
                ])
                ->columns(2)
                ->defaultItems(fn () => PriceType::count()) // automatically create rows for all price types
                ->reorderable(false)
                ->addable(false)
                ->deletable(false)
        ])
        ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\ImageColumn::make('image_path')
                //     ->disk('public')
                //     ->label('')
                //     ->circular()
                //     ->size(40)
                //     ->defaultImageUrl('https://via.placeholder.com/40'),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    // ->getStateUsing(fn ($record) =>
                    //     $record->image_path
                    //         ? asset('storage/' . $record->image_path)
                    //         : null
                    // )
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type.name')->label('Type'),
                Tables\Columns\TextColumn::make('capacity'),
                // Tables\Columns\TextColumn::make('prices.price'),
                Tables\Columns\TextColumn::make('prices.price')
                    ->label('SRP')
                    ->formatStateUsing(fn ($state, $record) => '₱ ' . number_format($record->price('srp'), 2))
                    // dd($record->price('srp'))
                        // $record->prices
                        //     ->map(fn ($p) => $p->priceType->label . ': ₱' . number_format($p->price, 2))
                        //     ->implode(', ')
                    // )
                    ->wrap(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = static::$model;

        return (string) $modelClass::get()->count();
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
