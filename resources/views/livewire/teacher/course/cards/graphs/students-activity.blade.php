<div wire:ignore class="card bg-gradient-default shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase ls-1 mb-1">Overview</h6>
                <h2 class="mb-0">Students Course Views</h2>
            </div>
            <div class="col">
                <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0">
                        <a wire:click="updateTime('1 day')" class="nav-link py-2 px-3" data-toggle="tab">
                            <span class="d-none d-md-block">Day</span>
                            <span class="d-md-none">D</span>
                        </a>
                    </li>
                    <li class="nav-item mr-2 mr-md-0">
                        <a wire:click="updateTime('1 week')" class="nav-link py-2 px-3" data-toggle="tab">
                            <span class="d-none d-md-block">Week</span>
                            <span class="d-md-none">W</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a wire:click="updateTime('1 month')" class="nav-link py-2 px-3 active" data-toggle="tab">
                            <span class="d-none d-md-block">Month</span>
                            <span class="d-md-none">M</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card-body">
        <!-- Chart -->
        <div class="chart">
            {{-- student activity chart.js --}}
            <div class="chart" wire:key="{{$course->id}}" wire:poll.5s="updateStudentsActivity">
                <canvas id="studentActivityChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- script --}}
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
    integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var studentActivityChart = document.getElementById('studentActivityChart').getContext('2d');
    var studentActivityChart = new Chart(studentActivityChart, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($studentsActivity as $studentName => $activities)
                '{{ $studentName }}',
                @endforeach
            ],
            datasets: [{
                label: 'Student Course Views',
                data: [
                    @foreach ($studentsActivity as $activities)
                    {{ $activities }},
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
            scales: {
                y: {
                    beginAtZero: true
                }
              }
        }
    });
    // livewire listen for events
    Livewire.on('addData', (data) => {
        
        Object.keys(data).forEach(studentName => {
            const index = studentActivityChart.data.labels.indexOf(studentName);
            studentActivityChart.data.datasets[0].data[index] = data[studentName];
        });

        studentActivityChart.update();
    });
    Livewire.on('updateTime', (data) => {
        

        Object.keys(data).forEach((studentName,index) => {
            studentActivityChart.data.labels[index] = studentName;
            studentActivityChart.data.datasets[0].data[index] = data[studentName];
        });

        // studentActivityChart.data.labels = [
        //     @foreach ($studentsActivity as $studentName => $activities)
        //         '{{ $studentName }}',
        //     @endforeach
        // ];
        // studentActivityChart.data.datasets[0].data = [
        //     @foreach ($studentsActivity as $activities)
        //             '{{ $activities }}',
        //     @endforeach
        // ];
        studentActivityChart.update();
    });
</script>
@endpush