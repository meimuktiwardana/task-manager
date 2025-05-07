<x-filament::widget>
    <x-filament::card>
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold tracking-tight">Task Count by User</h2>
            </div>
           
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($tasksByUser as $userData)
                    <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 shadow">
                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $userData->user_name }}</h3>
                        <p class="text-2xl font-bold text-primary-600">{{ $userData->task_count }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total Tasks</p>
                    </div>
                @endforeach
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>