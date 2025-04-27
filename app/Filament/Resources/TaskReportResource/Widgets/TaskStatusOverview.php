<?php

namespace App\Filament\Resources\TaskReportResource\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class TaskStatusOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $todoCount = Task::where('status', 'To Do')->count();
        $inProgressCount = Task::where('status', 'In Progress')->count();
        $doneCount = Task::where('status', 'Done')->count();
        $totalCount = Task::count();
        
        return [
            Card::make('Total Tugas', $totalCount)
                ->description('Seluruh tugas dalam sistem')
                ->descriptionIcon('heroicon-s-clipboard-list')
                ->chart([
                    $todoCount, $inProgressCount, $doneCount
                ])
                ->color('primary'),
            
            Card::make('To Do', $todoCount)
                ->description(number_format(($totalCount > 0 ? $todoCount / $totalCount * 100 : 0), 1) . '% dari total')
                ->descriptionIcon('heroicon-s-clipboard')
                ->color('danger'),
            
            Card::make('In Progress', $inProgressCount)
                ->description(number_format(($totalCount > 0 ? $inProgressCount / $totalCount * 100 : 0), 1) . '% dari total')
                ->descriptionIcon('heroicon-s-refresh')
                ->color('warning'),
            
            Card::make('Done', $doneCount)
                ->description(number_format(($totalCount > 0 ? $doneCount / $totalCount * 100 : 0), 1) . '% dari total')
                ->descriptionIcon('heroicon-s-check-circle')
                ->color('success'),
        ];
    }
}