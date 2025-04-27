<x-filament::page>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Laporan Status Tugas per User</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">User</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">To Do</th>
                        <th scope="col" class="px-6 py-3">In Progress</th>
                        <th scope="col" class="px-6 py-3">Done</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user['name'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user['email'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user['todo'] }}
                                <span class="text-xs text-gray-500">({{ $user['todo_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $user['in_progress'] }}
                                <span class="text-xs text-gray-500">({{ $user['in_progress_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $user['done'] }}
                                <span class="text-xs text-gray-500">({{ $user['done_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4 font-bold">
                                {{ $user['total'] }}
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <td colspan="6" class="px-6 py-4 text-center">Tidak ada user yang ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900">
                        <th scope="row" class="px-6 py-3 text-base" colspan="2">Total</th>
                        <td class="px-6 py-3">{{ $users->sum('todo') }}</td>
                        <td class="px-6 py-3">{{ $users->sum('in_progress') }}</td>
                        <td class="px-6 py-3">{{ $users->sum('done') }}</td>
                        <td class="px-6 py-3">{{ $users->sum('total') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Grafik Status Tugas per User</h3>
            <div class="w-full h-64" id="userChart"></div>
        </div>
    </x-filament::card>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const userData = @json($users);
                
                const userNames = userData.map(u => u.name);
                const todoData = userData.map(u => u.todo);
                const inProgressData = userData.map(u => u.in_progress);
                const doneData = userData.map(u => u.done);
                
                var options = {
                    series: [{
                        name: 'To Do',
                        data: todoData
                    }, {
                        name: 'In Progress',
                        data: inProgressData
                    }, {
                        name: 'Done',
                        data: doneData
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                        toolbar: {
                            show: true
                        },
                        zoom: {
                            enabled: true
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0
                            }
                        }
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            borderRadius: 2
                        },
                    },
                    xaxis: {
                        type: 'category',
                        categories: userNames,
                    },
                    legend: {
                        position: 'bottom',
                    },
                    fill: {
                        opacity: 1
                    },
                    colors: ['#EF4444', '#F59E0B', '#10B981']
                };

                var chart = new ApexCharts(document.querySelector("#userChart"), options);
                chart.render();
            });
        </script>
    @endpush
</x-filament::page>