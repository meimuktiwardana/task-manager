<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function ($livewire) {
                    // Emit event to refresh widget after task creation
                    $livewire->emit('taskCreated');
                }),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            TaskResource\Widgets\TaskCountByUserWidget::class,
        ];
    }
}