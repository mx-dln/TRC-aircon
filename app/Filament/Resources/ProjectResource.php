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
                            ->label('')
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
                            ->imageEditorViewportWidth('1200')
                            ->imageEditorViewportHeight('800')
                            ->uploadingMessage('Uploading project images...')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => 'project-progress/project-' . time() . '-' . $file->getClientOriginalName()
                            )
                            ->dehydrated(false)
                            ->maxSize(10240) // 10MB max file size
                            ->acceptedFileTypes(['image/*'])
                            ->disk('public')
                            ->visibility('public')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('800')
                            ->imageResizeMode('cover')
                            ->imagePreviewHeight('250')
                            ->imageEditor()
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
                            ->afterStateUpdated(function ($state, $record) {
                                if (!$record) {
                                    \Log::warning('No record provided to afterStateUpdated');
                                    return [];
                                }
                                
                                try {
                                    // Get existing images
                                    $existingImages = [];
                                    if (!empty($record->images)) {
                                        if (is_string($record->images)) {
                                            $existingImages = json_decode($record->images, true) ?: [];
                                        } elseif (is_array($record->images)) {
                                            $existingImages = $record->images;
                                        }
                                    }
                                    
                                    $newImages = [];
                                    
                                    if (is_array($state) || is_object($state)) {
                                        $state = (array) $state;
                                        
                                        foreach ($state as $key => $value) {
                                            try {
                                                // Handle temporary uploads (Livewire temporary files)
                                                if (is_object($value) && method_exists($value, 'getRealPath')) {
                                                    $tempPath = $value->getRealPath();
                                                    $originalName = $value->getClientOriginalName();
                                                    $extension = $value->getClientOriginalExtension();
                                                    $filename = 'project-' . time() . '-' . substr(md5($originalName), 0, 8) . '.' . $extension;
                                                    $destination = 'project-progress/' . $filename;
                                                    
                                                    // Ensure the directory exists
                                                    if (!\Storage::disk('public')->exists('project-progress')) {
                                                        \Storage::disk('public')->makeDirectory('project-progress');
                                                    }
                                                    
                                                    // Store the file
                                                    $stored = \Storage::disk('public')->put($destination, file_get_contents($tempPath));
                                                    
                                                    if ($stored) {
                                                        $newImages[] = $destination;
                                                        \Log::info('Stored new file', [
                                                            'from' => $tempPath,
                                                            'to' => $destination
                                                        ]);
                                                    } else {
                                                        \Log::error('Failed to store file', [
                                                            'temp_path' => $tempPath,
                                                            'destination' => $destination
                                                        ]);
                                                    }
                                                }
                                                // Handle string paths (existing files)
                                                elseif (is_string($value) && !empty($value)) {
                                                    // Skip temporary paths
                                                    if (str_contains($value, 'livewire-tmp/')) {
                                                        continue;
                                                    }
                                                    
                                                    // Add existing paths that aren't already in the list
                                                    if (!in_array($value, $existingImages)) {
                                                        $newImages[] = $value;
                                                    }
                                                }
                                            } catch (\Exception $e) {
                                                \Log::error('Error processing file:', [
                                                    'key' => $key,
                                                    'value' => $value,
                                                    'error' => $e->getMessage(),
                                                    'trace' => $e->getTraceAsString()
                                                ]);
                                                continue;
                                            }
                                        }
                                    }
                                    
                                    // Merge existing and new images, ensuring uniqueness
                                    $allImages = array_values(array_unique(array_merge($existingImages, $newImages)));
                                    \Log::info('All images to save:', ['images' => $allImages]);
                                    
                                    // Update the record directly in the database
                                    $saved = \DB::table('projects')
                                        ->where('id', $record->id)
                                        ->update([
                                            'images' => !empty($allImages) ? json_encode($allImages) : null,
                                            'updated_at' => now()
                                        ]);
                                    
                                    // Refresh the record
                                    $record->refresh();
                                    
                                    // Debug: Log the record after save
                                    \Log::info('After save:', [
                                        'saved' => $saved, 
                                        'record_id' => $record->id,
                                        'images_saved' => $record->images,
                                        'images_count' => is_array($record->images) ? count($record->images) : 0,
                                        'raw_attributes' => $record->getAttributes(),
                                        'raw_original' => $record->getOriginal()
                                    ]);
                                    
                                    // Clear the file upload state to prevent duplicate uploads
                                    return [];
                                    
                                } catch (\Exception $e) {
                                    \Log::error('Error in afterStateUpdated: ' . $e->getMessage(), [
                                        'trace' => $e->getTraceAsString()
                                    ]);
                                    throw $e;
                                }
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
