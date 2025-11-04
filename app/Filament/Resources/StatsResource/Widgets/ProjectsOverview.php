<?php

namespace App\Filament\Resources\StatsResource\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class ProjectsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    
    protected function getStats(): array
    {
        $totalProjects = Project::count();
        $averageProgress = Project::avg('progress') ?? 0;
        $completedProjects = Project::where('progress', 100)->count();
        $inProgressProjects = Project::where('progress', '>', 0)
            ->where('progress', '<', 100)
            ->count();

        return [
            Stat::make('Total Projects', $totalProjects)
                ->description('All projects in the system')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),
                
            Stat::make('Average Progress', round($averageProgress) . '%')
                ->description('Average completion across all projects')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color($averageProgress > 70 ? 'success' : ($averageProgress > 30 ? 'warning' : 'danger')),
                
            Stat::make('Completed Projects', $completedProjects)
                ->description(Number::percentage($totalProjects > 0 ? ($completedProjects / $totalProjects) * 100 : 0, 1) . ' of all projects')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
                
            Stat::make('In Progress', $inProgressProjects)
                ->description('Projects currently in progress')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
        ];
    }
}
