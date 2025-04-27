<?php
namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';
    protected static ?string $recordTitleAttribute = 'title';
    
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
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
        ];
       
        return $form->schema($formFields);
    }
    
    public static function table(Table $table): Table
    {
        $isAdmin = Auth::user()->hasRole('super_admin');
        
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'To Do',
                        'warning' => 'In Progress',
                        'success' => 'Done',
                    ]),
                Tables\Columns\TextColumn::make('deadline')
                    ->date(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Assigned To'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'To Do' => 'To Do',
                        'In Progress' => 'In Progress',
                        'Done' => 'Done',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => Auth::user()->hasRole('super_admin')),
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
    
    protected function canEdit(mixed $record): bool
    {
        // Regular users can only edit their own tasks
        if (!Auth::user()->hasRole('super_admin')) {
            return $record->user_id === Auth::id();
        }
        
        return true;
    }
}