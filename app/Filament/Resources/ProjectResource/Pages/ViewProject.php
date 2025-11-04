<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Components\Section::make('Project Information')
                ->schema([
                    Components\Grid::make(2)
                        ->schema([
                            Components\TextEntry::make('client_name'),
                            Components\TextEntry::make('contact_number'),
                            Components\TextEntry::make('address')
                                ->columnSpanFull(),
                            Components\TextEntry::make('progress')
                                ->formatStateUsing(fn ($state) => "{$state}%")
                                ->color(fn ($state) => $state < 50 ? 'warning' : 'success'),
                            Components\TextEntry::make('public_token')
                                ->label('Public Link')
                                ->formatStateUsing(fn ($state) => url("/project/{$state}"))
                                ->copyable(),
                            Components\TextEntry::make('created_at')
                                ->dateTime(),
                            Components\TextEntry::make('updated_at')
                                ->dateTime(),
                        ]),
                ]),
            Components\Section::make('Progress Images')
                ->hidden(fn ($record) => empty($record->progress_images))
                ->schema([
                    Components\Grid::make(3)
                        ->schema(
                            fn ($record) => collect($record->progress_images)->map(
                                fn ($image) => Components\ImageEntry::make('')
                                    ->getStateUsing($image)
                                    ->disk('public')
                                    ->height(200)
                                    ->extraImgAttributes([
                                        'class' => 'rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-zoom-in',
                                        'onclick' => "window.open('" . asset('storage/' . $image) . "', '_blank')",
                                    ])
                                    ->columnSpan(1)
                            )->toArray()
                        )->columns(3),
                ]),
        ]);
    }
}
