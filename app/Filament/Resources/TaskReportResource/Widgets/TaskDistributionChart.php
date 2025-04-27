<?php

namespace App\Filament\Resources\TaskReportResource\Widgets;

use App\Models\Task;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class TaskDistributionChart extends Widget
{
    protected static string $view = 'filament.resources.task-report-resource.widgets.task-distribution-chart';
    
    public function getTaskStatusData()
    {
        $statusCounts = Task::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
            
        return [
            'labels' => array_keys($statusCounts),
            'data' => array_values($statusCounts),
        ];
    }
    
    protected function getViewData(): array
    {
        return [
            'chartData' => $this->getTaskStatusData(),
        ];
    }
}