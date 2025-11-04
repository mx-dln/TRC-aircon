<?php

namespace App\Filament\Resources;

use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 1;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'name')
                            ->required(),
                        Forms\Components\DatePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('Y-m-d')
                            ->closeOnDateSelection(),
                        Forms\Components\DatePicker::make('end_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('Y-m-d')
                            ->minDate(fn (Forms\Get $get) => $get('start_date')),
                        Forms\Components\TextInput::make('progress')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(1)
                            ->suffix('%'),
                    ]),
                Forms\Components\Section::make('Project Images')
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            ->label('Project Images')
                            ->multiple()
                            ->image()
                            ->directory('project-progress')
                            ->preserveFilenames()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->reorderable()
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->columnSpanFull()
                            ->imagePreviewHeight('150')
                            ->maxSize(10240) // 10MB max file size
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->visibility('public')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('800')
                            ->imageResizeMode('cover')
                            ->imagePreviewHeight('250')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => 'project-progress/project-' . time() . '-' . $file->getClientOriginalName()
                            )
                            ->afterStateHydrated(function (BaseFileUpload $component, $state, $record) {
                                if (!$record) {
                                    $component->state([]);
                                    return;
                                }

                                $images = $record->images;
                                
                                if (empty($images)) {
                                    $component->state([]);
                                    return;
                                }
                                
                                if (is_string($images)) {
                                    $images = json_decode($images, true) ?: [];
                                }
                                
                                if (is_object($images)) {
                                    $images = (array) $images;
                                }
                                
                                $filePaths = [];
                                
                                if (is_array($images)) {
                                    foreach ($images as $value) {
                                        if (is_string($value) && !empty($value)) {
                                            if (strpos($value, 'http') === 0) {
                                                $parsed = parse_url($value);
                                                $value = ltrim($parsed['path'] ?? '', '/');
                                                $value = preg_replace('#^storage/#', '', $value);
                                            }
                                            $filePaths[] = $value;
                                        }
                                    }
                                }
                                
                                $component->state($filePaths);
                            })
                    ])
                ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.phone')
                    ->label('Contact')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('progress')
                    ->suffix('%')
                    ->sortable()
                    ->color(fn ($record) => $record->progress < 50 ? 'warning' : 'success'),
                Tables\Columns\ImageColumn::make('image_urls')
                    ->label('Images')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('public_link')
                    ->label('Public Link')
                    ->formatStateUsing(fn ($state, $record) => url("/project/{$record->public_token}"))
                    ->copyable()
                    ->copyMessage('Public link copied to clipboard!')
                    ->copyMessageDuration(1500)
                    ->searchable()
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono text-sm']),
            ])
            ->filters([
                // Add any filters here if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function beforeCreate($record): void
    {
        $record->public_token = (string) Str::uuid();
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ProjectResource\Pages\ListProjects::route('/'),
            // 'create' => \App\Filament\Resources\ProjectResource\Pages\CreateProject::route('/create'),
            // 'edit' => \App\Filament\Resources\ProjectResource\Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            // Add your relations here
        ];
    }

    public static function getBreadcrumbs(): array
    {
        return [
            'index' => 'Projects',
            'create' => 'Create Project',
            'edit' => 'Edit Project',
        ];
    }
}
