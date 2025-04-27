<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

use App\Filament\Resources\TaskReportResource;
use Filament\Facades\Filament; 
use Filament\Navigation\NavigationGroup; 

class FilamentAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Define permissions for project
        $projectPermissions = [
            'project.view',
            'project.viewAny',
            'project.create',
            'project.update',
            'project.delete',
        ];

        // Define permissions for task
        $taskPermissions = [
            'task.view',
            'task.viewAny',
            'task.create',
            'task.update',
            'task.delete',
        ];

        // Create permissions if they don't exist
        $allPermissions = array_merge($projectPermissions, $taskPermissions);
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Super admin gets all permissions
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole) {
            $superAdminRole->syncPermissions($allPermissions);
        }

        // filament_user only gets limited permissions
        $userRole = Role::where('name', 'filament_user')->first();
        if ($userRole) {
            $userRole->syncPermissions([
                'task.view',
                'task.viewAny',
                'task.update',
                'project.view',
                'project.viewAny',
            ]);
        }

        // Define Gates for all permissions
        foreach ($allPermissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                return $user->hasPermissionTo($permission);
            });
        }

        // Daftarkan resource laporan tugas
        Filament::serving(function () {
            // Mendaftarkan grup navigasi Reports jika belum ada
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Reports')
                    ->icon('heroicon-o-chart-bar'),
            ]);
        });
    }
}