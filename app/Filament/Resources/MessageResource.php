<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $modelLabel = 'Message';
    protected static ?string $navigationLabel = 'Messages';
    protected static ?string $navigationGroup = 'Communication';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form fields for viewing a message
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordClasses(fn (Message $record) => match (true) {
                $record->is_read => 'bg-white dark:bg-gray-800',
                default => 'bg-blue-50 dark:bg-gray-700',
            })
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->icon(fn (bool $state): string => $state ? 'heroicon-o-envelope' : 'heroicon-o-envelope-open')
                    ->color(fn (bool $state): string => $state ? 'gray' : 'primary')
                    ->action(
                        Tables\Actions\Action::make('toggleRead')
                            ->button()
                            ->icon(fn (Message $record) => $record->is_read ? 'heroicon-o-envelope' : 'heroicon-o-envelope-open')
                            ->action(function (Message $record) {
                                $record->update(['is_read' => !$record->is_read]);
                                
                                Notification::make()
                                    ->title('Marked as ' . ($record->is_read ? 'read' : 'unread'))
                                    ->success()
                                    ->send();
                            })
                    ),
                Tables\Columns\TextColumn::make('name')
                    ->label('From')
                    ->description(fn (Message $record) => $record->email)
                    ->searchable(['name', 'email'])
                    ->sortable()
                    ->weight(fn (Message $record) => $record->is_read ? 'normal' : 'bold')
                    ->color(fn (Message $record) => $record->is_read ? null : 'primary'),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->weight(fn (Message $record) => $record->is_read ? 'normal' : 'bold')
                    ->tooltip(fn (Message $record) => $record->subject),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M j, Y g:i A')
                    ->sortable()
                    ->toggleable()
                    ->color(fn (Message $record) => $record->is_read ? 'gray' : 'primary'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_read')
                    ->label('Status')
                    ->options([
                        '0' => 'Unread',
                        '1' => 'Read',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match($data['value'] ?? null) {
                            '0' => $query->where('is_read', false),
                            '1' => $query->where('is_read', true),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->button()
                    ->after(fn (Message $record) => $record->markAsRead()),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->icon('heroicon-o-trash')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->icon('heroicon-o-envelope')
                        ->label('Mark as read')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $records->each->markAsRead();
                            
                            Notification::make()
                                ->title('Messages marked as read')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('markAsUnread')
                        ->icon('heroicon-o-envelope-open')
                        ->label('Mark as unread')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $records->each->markAsUnread();
                            
                            Notification::make()
                                ->title('Messages marked as unread')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'view' => Pages\ViewMessage::route('/{record}'),
        ];
    }
}
