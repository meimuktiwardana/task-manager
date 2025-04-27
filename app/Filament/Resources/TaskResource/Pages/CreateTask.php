<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If not admin, set user_id to current user
        if (!Auth::user()->hasRole('super_admin')) {
            $data['user_id'] = Auth::id();
        }
        
        return $data;
    }
}
