<x-filament::card>
    <h2 class="text-lg font-bold mb-4">Distribusi Status Tugas</h2>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-md h-64" id="taskDistributionChart"></div>
    </div>
</x-filament::card>

@pushonce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpushonce

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);
        
        const options = {
            series: chartData.data,
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: chartData.labels,
            colors: ['#EF4444', '#F59E0B', '#10B981'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const chart = new ApexCharts(document.querySelector("#taskDistributionChart"), options);
        chart.render();
    });
</script>