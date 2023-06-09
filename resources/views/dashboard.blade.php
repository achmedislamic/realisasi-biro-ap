<x-app-layout>
    <div class="flex flex-col space-y-3 items-center justify-center">
        <div class="w-1/3 flex flex-col items-center justify-center">
            <h2>Realisasi VS Anggaran</h2>
            <canvas id="myChart"></canvas>
        </div>
        <div class="w-full">
            @livewire('sub-opd-modal-dashboard')
            @livewire('table-dashboard')
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'pie',
                plugins: [ChartDataLabels],
                data: {
                    labels: ['Realisasi', 'Anggaran'],
                    datasets: [{
                        label: 'Realisasi VS Anggaran',
                        data: [{{ $realisasi }}, {{ $anggaran }}],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive : true,
                    plugins: {
                        datalabels: {
                            backgroundColor: 'white',
                            color: 'black',
                            padding: 3
                        }
                    }
                }
            });
        </script>
    @endpush

</x-app-layout>
