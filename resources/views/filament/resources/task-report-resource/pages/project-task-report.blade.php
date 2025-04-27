<x-filament::page>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Laporan Status Tugas per Proyek</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Proyek</th>
                        <th scope="col" class="px-6 py-3">To Do</th>
                        <th scope="col" class="px-6 py-3">In Progress</th>
                        <th scope="col" class="px-6 py-3">Done</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $project['name'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $project['todo'] }}
                                <span class="text-xs text-gray-500">({{ $project['todo_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $project['in_progress'] }}
                                <span class="text-xs text-gray-500">({{ $project['in_progress_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $project['done'] }}
                                <span class="text-xs text-gray-500">({{ $project['done_percent'] }}%)</span>
                            </td>
                            <td class="px-6 py-4 font-bold">
                                {{ $project['total'] }}
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b">
                            <td colspan="5" class="px-6 py-4 text-center">Tidak ada proyek yang ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900">
                        <th scope="row" class="px-6 py-3 text-base">Total</th>
                        <td class="px-6 py-3">{{ $projects->sum('todo') }}</td>
                        <td class="px-6 py-3">{{ $projects->sum('in_progress') }}</td>
                        <td class="px-6 py-3">{{ $projects->sum('done') }}</td>
                        <td class="px-6 py-3">{{ $projects->sum('total') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Grafik Status Tugas per Proyek</h3>
            <div class="w-full h-64" id="projectChart"></div>
        </div>
    </x-filament::card>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const projectData = @json($projects);
                
                const projectNames = projectData.map(p => p.name);
                const todoData = projectData.map(p => p.todo);
                const inProgressData = projectData.map(p => p.in_progress);
                const doneData = projectData.map(p => p.done);
                
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
                        categories: projectNames,
                    },
                    legend: {
                        position: 'bottom',
                    },
                    fill: {
                        opacity: 1
                    },
                    colors: ['#EF4444', '#F59E0B', '#10B981']
                };

                var chart = new ApexCharts(document.querySelector("#projectChart"), options);
                chart.render();
            });
        </script>
    @endpush
</x-filament::page>