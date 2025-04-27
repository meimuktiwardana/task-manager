<?php
namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;
    
    protected function getActions(): array
    {
        $actions = [];
        
        if (Auth::user()->hasRole('super_admin')) {
            $actions[] = Actions\EditAction::make();
            $actions[] = Actions\DeleteAction::make();
        }
        
        return $actions;
    }
}