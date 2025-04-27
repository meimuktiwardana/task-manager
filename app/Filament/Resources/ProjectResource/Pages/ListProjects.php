<?php
namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        $actions = [];
        
        if (Auth::user()->hasRole('super_admin')) {
            $actions[] = Actions\CreateAction::make();
        }
        
        return $actions;
    }
}