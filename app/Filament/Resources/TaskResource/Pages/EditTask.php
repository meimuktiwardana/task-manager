<?php
namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;
    
    protected function getActions(): array
    {
        $actions = [];
       
        if (Auth::user()->hasRole('super_admin')) {
            $actions[] = Actions\DeleteAction::make();
        }
       
        return $actions;
    }
   
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!Auth::user()->hasRole('super_admin')) {
            // Preserve all original values except status for non-admins
            $data['title'] = $this->record->title;
            $data['user_id'] = $this->record->user_id;
            $data['project_id'] = $this->record->project_id;
            $data['deadline'] = $this->record->deadline;
            // Status can be updated by regular users
        }
       
        return $data;
    }
    
    protected function canEdit(): bool
    {
        // Regular users can only edit their own tasks
        if (!Auth::user()->hasRole('super_admin')) {
            return $this->record->user_id === Auth::id();
        }
        
        return true;
    }
}