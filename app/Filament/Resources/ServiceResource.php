<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Service Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Supply & Installation'),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(500)
                            ->rows(3),

                        Forms\Components\Select::make('color')
                            ->required()
                            ->options([
                                'blue' => 'Blue',
                                'green' => 'Green',
                                'purple' => 'Purple',
                                'yellow' => 'Yellow',
                                'red' => 'Red',
                                'indigo' => 'Indigo',
                            ])
                            ->default('blue'),

                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->placeholder('e.g., heroicon-o-wrench-screwdriver')
                            ->helperText('Enter the icon name (optional)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Video Settings')
                    ->schema([
                        Forms\Components\Select::make('video_type')
                            ->options([
                                'youtube' => 'YouTube',
                                'vimeo' => 'Vimeo',
                                'file' => 'Upload Video File',
                            ])
                            ->nullable()
                            ->reactive()
                            ->helperText('Choose where your video is hosted'),

                        Forms\Components\TextInput::make('video_url')
                            ->visible(fn (callable $get) => in_array($get('video_type'), ['youtube', 'vimeo']))
                            ->placeholder('Paste the full video URL')
                            ->helperText('YouTube: https://www.youtube.com/watch?v=... or Vimeo: https://vimeo.com/...'),

                        Forms\Components\FileUpload::make('video_file')
                            ->visible(fn (callable $get) => $get('video_type') === 'file')
                            ->disk('public')
                            ->directory('videos')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                            ->maxSize(512 * 1024) // 512MB
                            ->helperText('Accepted formats: MP4, WebM, OGG (Max 512MB)'),
                    ]),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('video_type')
                    ->colors([
                        'blue' => 'youtube',
                        'red' => 'vimeo',
                        'green' => 'file',
                    ])
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'youtube' => 'YouTube',
                        'vimeo' => 'Vimeo',
                        'file' => 'Uploaded File',
                        default => 'No Video',
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
