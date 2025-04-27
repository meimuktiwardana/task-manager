<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';
    
    protected static ?string $navigationGroup = 'Project Management';

    public static function form(Form $form): Form
    {
        $isAdmin = Auth::user()->hasRole('super_admin');
        
        // Regular users can only update status
        if (!$isAdmin) {
            return $form->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'To Do' => 'To Do',
                        'In Progress' => 'In Progress',
                        'Done' => 'Done',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('deadline')
                    ->required()
                    ->disabled(),
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->disabled()
                    ->dehydrated(false)
                    ->label('Project'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->dehydrated(false)
                    ->label('Assigned To'),
            ]);
        }
        
        // Admin form with all editable fields
        $formFields = [
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('status')
                ->options([
                    'To Do' => 'To Do',
                    'In Progress' => 'In Progress',
                    'Done' => 'Done',
                ])
                ->required(),
            Forms\Components\DatePicker::make('deadline')
                ->required(),
            Forms\Components\Select::make('project_id')
                ->relationship('project', 'name')
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
        ];
        
        return $form->schema($formFields);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'To Do',
                        'warning' => 'In Progress',
                        'success' => 'Done',
                    ]),
                Tables\Columns\TextColumn::make('deadline')
                    ->date(),
                Tables\Columns\TextColumn::make('project.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Assigned To')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'To Do' => 'To Do',
                        'In Progress' => 'In Progress',
                        'Done' => 'Done',
                    ]),
                Tables\Filters\SelectFilter::make('project_id')
                    ->relationship('project', 'name')
                    ->label('Project'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => Auth::user()->hasRole('super_admin')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => Auth::user()->hasRole('super_admin')),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        // If not admin, only show tasks assigned to current user
        if (!Auth::user()->hasRole('super_admin')) {
            $query->where('user_id', Auth::id());
        }
        
        return $query;
    }
    
    public static function canCreate(): bool
    {
        return Auth::user()->hasRole('super_admin');
    }
    
    public static function getPermission(string $action): ?string
    {
        return "task.{$action}";
    }
}