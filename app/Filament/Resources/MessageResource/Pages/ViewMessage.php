<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Back to Inbox')
                ->url(MessageResource::getUrl('index'))
                ->icon('heroicon-o-arrow-left')
                ->color('gray'),
            Actions\DeleteAction::make()
                ->label('')
                ->tooltip('Delete')
                ->icon('heroicon-o-trash')
                ->size('sm'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        // Header with subject
                        ViewEntry::make('subject')
                            ->view('filament.infolists.messages.subject', [
                                'subject' => $this->record->subject,
                                'date' => $this->record->created_at->format('M j, Y, g:i A'),
                            ]),

                        // Sender information
                        ViewEntry::make('sender')
                            ->view('filament.infolists.messages.sender', [
                                'name' => $this->record->name,
                                'email' => $this->record->email,
                                'phone' => $this->record->phone,
                                'date' => $this->record->created_at->diffForHumans(),
                            ]),

                        // Message content
                        ViewEntry::make('message')
                            ->view('filament.infolists.messages.content', [
                                'content' => $this->record->message,
                            ]),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 1;
    }
}
