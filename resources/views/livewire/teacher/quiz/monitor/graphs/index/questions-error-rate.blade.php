<div wire:ignore class="card bg-gradient-default shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase ls-1 mb-1">Overview</h6>
                <h2 class="mb-1">Questions Error Rate</h2>
            </div>
        </div>

    </div>

    <div class="card-body">
        <!-- Chart -->
        <div class="chart">
            {{-- student activity chart.js --}}
            <div class="chart" wire:key="{{$quiz->id}}">
                <canvas id="QuestionsErrorRateChart" style="height:250px"></canvas>
            </div>
        </div>
        <div class="mt-3 row align-items-center justify-content-center">
            <livewire:teacher.quiz.monitor.graphs.index.questions-bar :quiz="$quiz" />
        </div>
    </div>
</div>
{{-- @once
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@endonce --}}

@push('js')
<script>
    //wait until the page is loaded to render the chart and avoid the error
    $(document).ready(function () {
    var QuestionsErrorRateChart = document.getElementById('QuestionsErrorRateChart').getContext('2d');
    var QuestionsErrorRateChart = new Chart(QuestionsErrorRateChart, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($graph_data as $q_id => $data)
                '{{ $q_id }}',
                @endforeach
            ],
            datasets: [{
                label: 'Questions Error Rate',
                data: [
                    @foreach ($graph_data as $data)
                    {{ $data['error_rate'] }},
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
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    min: 0,
                    max: 1
                },
              }
        }
    });

    // // livewire listen for events
    Livewire.on('addData', (q_id, data) => {
        let index = QuestionsErrorRateChart.data.labels.indexOf(q_id);
        if(index == -1) {
            index = QuestionsErrorRateChart.data.labels.length;
        }
        QuestionsErrorRateChart.data.labels[index] = q_id;
        QuestionsErrorRateChart.data.datasets[0].data[index] = data['error_rate'];
        
        QuestionsErrorRateChart.update();
    });
    Livewire.on('deleteData', (q_id) => {
        let index = QuestionsErrorRateChart.data.labels.indexOf(q_id);
        QuestionsErrorRateChart.data.labels.splice(index, 1);
        QuestionsErrorRateChart.data.datasets[0].data.splice(index, 1);
        QuestionsErrorRateChart.update();
    });

    Livewire.on('deleteAllData', () => {
        QuestionsErrorRateChart.data.labels = [];
        QuestionsErrorRateChart.data.datasets[0].data = [];
        QuestionsErrorRateChart.update();
    });
});
</script>
@endpush