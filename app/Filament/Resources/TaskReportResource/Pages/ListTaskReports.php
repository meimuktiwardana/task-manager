<?php 
namespace App\Filament\Resources\TaskReportResource\Pages;

use App\Filament\Resources\TaskReportResource;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListTaskReports extends ListRecords
{
    protected static string $resource = TaskReportResource::class;
    
    protected static ?string $title = 'Laporan Ringkas Tugas';
    
    protected function getActions(): array
    {
        return [
            Actions\Action::make('project_report')
                ->label('Laporan per Proyek')
                ->url(route('filament.resources.task-reports.project-report')),
            Actions\Action::make('user_report')
                ->label('Laporan per User')
                ->url(route('filament.resources.task-reports.user-report')),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            TaskReportResource\Widgets\TaskStatusOverview::class,
            TaskReportResource\Widgets\TaskDistributionChart::class,
        ];
    }
    
    public function mount(): void
    {
        parent::mount();
        // We don't need the configure() call anymore
    }
    
    protected function getTableQuery(): Builder
    {
        // Return empty query as we're not showing a table
        return Task::query()->whereRaw('1 = 0');
    }
    
    // This is the correct method to disable pagination in Filament 2
    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}