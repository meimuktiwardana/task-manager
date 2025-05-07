<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Models\Task;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TaskCountByUserWidget extends Widget
{
    protected static string $view = 'filament.resources.task-resource.widgets.task-count-by-user-widget';
   
    protected int|string|array $columnSpan = 'full';
    
    // Add Livewire listeners for task events
    protected $listeners = [
        'taskDeleted' => '$refresh',
        'taskCreated' => '$refresh',
        'taskUpdated' => '$refresh',
    ];
    
    // Set widget ID for targeted event emission
    public static function getDefaultName(): ?string
    {
        return 'task-count-by-user-widget';
    }
   
    public function render(): View
    {
        $tasksByUser = $this->getTaskCountByUser();
       
        return view(static::$view, [
            'tasksByUser' => $tasksByUser,
        ]);
    }
   
    protected function getTaskCountByUser()
    {
        $query = Task::query()
            ->select('users.name as user_name', 'users.id as user_id', DB::raw('COUNT(*) as task_count'))
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->orderBy('task_count', 'desc');
           
        // If not admin, only show data for current user
        // if (!Auth::user()->hasRole('super_admin')) {
            $query->where('user_id', Auth::id());
        // }
       
        return $query->get();
    }
}