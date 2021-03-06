<div wire:ignore class="card bg-gradient-default shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-12">
                <h6 class="text-uppercase ls-1 mb-1">Overview</h6>
                <h2 class="mb-1">Knowledge Components Error Rate</h2>
            </div>
        </div>
    </div>

    <div class="card-body">
        <!-- Chart -->
        <div class="chart">
            {{-- student activity chart.js --}}
            <div class="chart">
                <canvas id="KcsErrorRateChart" style="height:250px"></canvas>
            </div>
        </div>
        <div class="mt-3 row align-items-center justify-content-center">
            <livewire:teacher.quiz.monitor.graphs.index.kcs-bar :quiz="$quiz" />
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
    var KcsErrorRateChart = document.getElementById('KcsErrorRateChart').getContext('2d');
    var KcsErrorRateChart = new Chart(KcsErrorRateChart, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($graph_data as $kc => $data)
                '{{ $kc }}',
                @endforeach
            ],
            datasets: [{
                label: 'Knowledge Component Error Rate',
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
    Livewire.on('addKcDataToGraph', (kc_name, data) => {
        let index = KcsErrorRateChart.data.labels.indexOf(kc_name);
        if(index == -1) {
            index = KcsErrorRateChart.data.labels.length;
        }
        KcsErrorRateChart.data.labels[index] = kc_name;
        KcsErrorRateChart.data.datasets[0].data[index] = data['error_rate'];
        
        KcsErrorRateChart.update();
    });
    Livewire.on('deleteKcDataFromGraph', (kc_name) => {
        let index = KcsErrorRateChart.data.labels.indexOf(kc_name);
        KcsErrorRateChart.data.labels.splice(index, 1);
        KcsErrorRateChart.data.datasets[0].data.splice(index, 1);
        KcsErrorRateChart.update();
    });

    Livewire.on('deleteAllKcDataFromGraph', () => {
        KcsErrorRateChart.data.labels = [];
        KcsErrorRateChart.data.datasets[0].data = [];
        KcsErrorRateChart.update();
    });

    Livewire.on('addAllKcDataToGraph', (data) => {
        KcsErrorRateChart.data.labels = [];
        KcsErrorRateChart.data.datasets[0].data = [];

        Object.entries(data).forEach((element) => {
            KcsErrorRateChart.data.labels.push(element[0]);
            KcsErrorRateChart.data.datasets[0].data.push(element[1].error_rate);
        });
        KcsErrorRateChart.update();
    });

    Livewire.on('deleteAllKcDataFromGraph', () => {
        KcsErrorRateChart.data.labels = [];
        KcsErrorRateChart.data.datasets[0].data = [];
        KcsErrorRateChart.update();
    });
});
</script>
@endpush