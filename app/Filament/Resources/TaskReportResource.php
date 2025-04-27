<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskReportResource\Pages;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskReport; // Gunakan model dummy
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TaskReportResource extends Resource
{
    protected static ?string $model = TaskReport::class; // Gunakan model dummy
    
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static ?string $navigationGroup = 'Reports';
    
    protected static ?string $navigationLabel = 'Task Reports';
    
    protected static ?string $slug = 'task-reports';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([]);
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskReports::route('/'),
            'project-report' => Pages\ProjectTaskReport::route('/project-report'),
            'user-report' => Pages\UserTaskReport::route('/user-report'),
        ];
    }
}