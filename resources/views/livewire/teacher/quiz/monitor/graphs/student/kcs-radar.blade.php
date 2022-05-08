<div wire:ignore class="card bg-gradient-default shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-12">
                <h6 class="text-uppercase ls-1 mb-1">Overview</h6>
                <h2 class="mb-1">
                    Quiz '<b>{{$quiz->name}}</b>' Knowledge Components Awareness Score
                </h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <!-- Chart -->
        <div class="chart">
            {{-- student activity chart.js --}}
            <div class="chart">
                <canvas id="StudentKcsRadarChart" style="height:250px"></canvas>
            </div>
        </div>
        <div class="mt-3 row align-items-center justify-content-center">
            {{--
            <livewire:teacher.quiz.monitor.graphs.index.kcs-bar :quiz="$quiz" /> --}}
        </div>
    </div>
</div>

@push('js')
<script>
    //wait until the page is loaded to render the chart and avoid the error
    $(document).ready(function () {
    var StudentKcsRadarChart = document.getElementById('StudentKcsRadarChart').getContext('2d');
    var StudentKcsRadarChart = new Chart(StudentKcsRadarChart, {
        type: 'radar',
        data: {
            labels: [
                @foreach ($graph_data as $kc_name => $rating)
                '{{ $kc_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'KC Awareness',
                data: [
                    @foreach ($graph_data as $kc_name => $rating)
                    {{ $rating }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
        }
    });
    StudentKcsRadarChart.data.datasets[0].borderColor.forEach((color, index) => {
        if (StudentKcsRadarChart.data.datasets[0].data[index] > 50) {
            StudentKcsRadarChart.data.datasets[0].borderColor[index] = '#00ff00';
        } else {
            StudentKcsRadarChart.data.datasets[0].borderColor[index] = '#ff0000';
        }
    });

    StudentKcsRadarChart.update();

    // // livewire listen for events
    // Livewire.on('addDataToKcRadarGraph', (kc_name, data) => {
    //     let index = StudentKcsRadarChart.data.labels.indexOf(kc_name);
    //     if(index == -1) {
    //         index = StudentKcsRadarChart.data.labels.length;
    //     }
    //     StudentKcsRadarChart.data.labels[index] = kc_name;
    //     StudentKcsRadarChart.data.datasets[0].data[index] = data['error_rate'];
        
    //     StudentKcsRadarChart.update();
    // });
    // Livewire.on('deleteKcDataFromRadarGraph', (kc_name) => {
    //     let index = StudentKcsRadarChart.data.labels.indexOf(kc_name);
    //     StudentKcsRadarChart.data.labels.splice(index, 1);
    //     StudentKcsRadarChart.data.datasets[0].data.splice(index, 1);
    //     StudentKcsRadarChart.update();
    // });

    // Livewire.on('deleteAllKcDataFromRadarGraph', () => {
    //     StudentKcsRadarChart.data.labels = [];
    //     StudentKcsRadarChart.data.datasets[0].data = [];
    //     StudentKcsRadarChart.update();
    // });
});
</script>
@endpush