<?php

namespace App\Filament\Resources\TaskReportResource\Pages;

use App\Filament\Resources\TaskReportResource;
use App\Models\Task;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class UserTaskReport extends Page
{
    protected static string $resource = TaskReportResource::class;
    
    protected static string $view = 'filament.resources.task-report-resource.pages.user-task-report';
    
    protected static ?string $title = 'Laporan Tugas per User';
    
    public $users = [];
    
    public function mount()
    {
        $this->users = User::all()->map(function ($user) {
            $todoCount = Task::where('user_id', $user->id)
                ->where('status', 'To Do')
                ->count();
                
            $inProgressCount = Task::where('user_id', $user->id)
                ->where('status', 'In Progress')
                ->count();
                
            $doneCount = Task::where('user_id', $user->id)
                ->where('status', 'Done')
                ->count();
                
            $totalCount = $todoCount + $inProgressCount + $doneCount;
            
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
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
            Actions\Action::make('project_report')
                ->label('Laporan per Proyek')
                ->url(route('filament.resources.task-reports.project-report')),
        ];
    }
}