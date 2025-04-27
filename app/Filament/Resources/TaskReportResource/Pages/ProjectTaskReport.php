<?php

namespace App\Filament\Resources\TaskReportResource\Pages;

use App\Filament\Resources\TaskReportResource;
use App\Models\Project;
use App\Models\Task;
use Filament\Pages\Actions;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class ProjectTaskReport extends Page
{
    protected static string $resource = TaskReportResource::class;
    
    protected static string $view = 'filament.resources.task-report-resource.pages.project-task-report';
    
    protected static ?string $title = 'Laporan Tugas per Proyek';
    
    public $projects = [];
    
    public function mount()
    {
        $this->projects = Project::all()->map(function ($project) {
            $todoCount = Task::where('project_id', $project->id)
                ->where('status', 'To Do')
                ->count();
                
            $inProgressCount = Task::where('project_id', $project->id)
                ->where('status', 'In Progress')
                ->count();
                
            $doneCount = Task::where('project_id', $project->id)
                ->where('status', 'Done')
                ->count();
                
            $totalCount = $todoCount + $inProgressCount + $doneCount;
            
            return [
                'id' => $project->id,
                'name' => $project->name,
                'todo' => $todoCount,
                'in_progress' => $inProgressCount,
                'done' => $doneCount,
                'total' => $totalCount,
                'todo_percent' => $totalCount > 0 ? round(($todoCount / $totalCount) * 100, 1) : 0,
                'in_progress_percent' => $totalCount > 0 ? round(($inProgressCount / $totalCount) * 100, 1) : 0,
                'done_percent' => $totalCount > 0 ? round(($doneCount / $totalCount) * 100, 1) : 0,
            ];
        });
    }
    
    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->url(route('filament.resources.task-reports.index')),
            Actions\Action::make('user_report')
                ->label('Laporan per User')
                ->url(route('filament.resources.task-reports.user-report')),
        ];
    }
}