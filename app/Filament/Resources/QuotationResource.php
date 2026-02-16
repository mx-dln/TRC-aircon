<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationResource\Pages;
use App\Filament\Resources\QuotationResource\RelationManagers;
use App\Models\Quotation;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuotationResource extends Resource
{
    protected static ?string $model = Quotation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Quotation Details')
                    ->schema([
                        Forms\Components\TextInput::make('project_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_no')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('contact_person')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('quotation_no')
                            ->required()
                            ->maxLength(255)
                            ->default(function () {
                                return 'Q-' . date('Y') . '-' . str_pad(Quotation::count() + 1, 4, '0', STR_PAD_LEFT);
                            }),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'sent' => 'Sent',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('draft'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Item Description')
                    ->visible(fn (string $context): bool => $context === 'create' || $context === 'edit')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'id')
                                    ->getOptionLabelFromRecordUsing(function (Product $record) {
                                        return $record->type->name . ' - ' . $record->brand->name . ' (' . $record->capacity . ')';
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->live(onBlur: true)
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => self::updateUnitPrice($state, $set, $get)),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set, $get) => self::updateAmount($state, $set, $get)),
                                Forms\Components\Select::make('unit')
                                    ->required()
                                    ->searchable()
                                    ->options(config('quotation.units'))
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
                                    ->prefix('₱')
                                    ->formatStateUsing(function ($get) {
                                        return $get('quantity') * $get('unit_price');
                                    }),
                            ])
                            ->columns(5)
                            ->collapsible()
                            // ->itemLabel(fn (array $state): ?string => $state['product_id'] ?? null),
                            ->itemLabel(function ($state) {
                                $productId = $state['product_id'] ?? null;
                                if ($productId) {
                                    $product = Product::find($productId);
                                    return $product ? $product->type->name . ' - ' . $product->brand->name . ' (' . $product->capacity . ')' : 'New Item';
                                }
                                return 'New Item';
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quotation_no')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_person')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('total_amount')
                //     ->money('PHP')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'draft' => 'heroicon-o-document-text',
                        'sent' => 'heroicon-o-paper-airplane',
                        'approved' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('View')
                    ->icon('heroicon-o-document')
                    ->color('success')
                    ->url(fn (Quotation $record) => url("/quotations/{$record->id}/pdf"))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->actionsColumnLabel('Actions')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\QuotationItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotations::route('/'),
            'create' => Pages\CreateQuotation::route('/create'),
            'edit' => Pages\EditQuotation::route('/{record}/edit'),
        ];
    }

    protected static function updateUnitPrice($productId, callable $set, callable $get = null)
    {
        if ($productId) {
            $product = Product::find($productId);
            if ($product) {
                $unitPrice = $product->price('srp') ?? 0;
                $set('unit_price', $unitPrice);
                
                // Also update amount if quantity is available
                if ($get) {
                    $quantity = $get('quantity') ?? 1;
                    $set('amount', $quantity * $unitPrice);
                }
            }
        } else {
            $set('unit_price', 0);
            if ($get) {
                $set('amount', 0);
            }
        }
    }

    protected static function updateAmount($quantity, callable $set, callable $get)
    {
        $unitPrice = $get('unit_price') ?? 0;
        $set('amount', $quantity * $unitPrice);
    }
}
