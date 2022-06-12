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
                        <a style="cursor: pointer;" wire:click="updateTime('1 day')" class="nav-link py-2 px-3"
                            data-toggle="tab">
                            <span class="d-none d-md-block">Day</span>
                            <span class="d-md-none">D</span>
                        </a>
                    </li>
                    <li class="nav-item mr-2 mr-md-0">
                        <a style="cursor: pointer;" wire:click="updateTime('1 week')" class="nav-link py-2 px-3"
                            data-toggle="tab">
                            <span class="d-none d-md-block">Week</span>
                            <span class="d-md-none">W</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" wire:click="updateTime('1 month')" class="nav-link py-2 px-3 active"
                            data-toggle="tab">
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
            <div class="chart" wire:key="{{$course->id}}">
                <canvas id="studentActivityChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {

        let data = [
                {
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
                borderWidth: 1,
                stack: 'combined',
                type: 'bar'
            },
            {
                    label: 'Student Lessons Views',
                    data: [
                    @foreach ($studentsLessonViews as $activities)
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
                type: 'line',
                    stack: 'combined'
                }
            ];


    var studentActivityChart = document.getElementById('studentActivityChart').getContext('2d');
    
    var studentActivityChart = new Chart(studentActivityChart, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($studentsActivity as $studentName => $activities)
                '{{ $studentName }}',
                @endforeach
            ],
            datasets: data
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
    Livewire.on('addCourseVisitData', (courseVisitsData, lessonVisitsData) => {
        studentActivityChart.data.labels = [];
        studentActivityChart.data.datasets[0].data = [];
        studentActivityChart.data.datasets[1].data = [];

        Object.keys(courseVisitsData).forEach(studentName => {
            let index = studentActivityChart.data.labels.indexOf(studentName);
            if(index == -1) {
                index = studentActivityChart.data.labels.length;
            }
            studentActivityChart.data.labels[index] = studentName;
            studentActivityChart.data.datasets[0].data[index] = courseVisitsData[studentName];
        });

        Object.keys(lessonVisitsData).forEach(studentName => {
            let index = studentActivityChart.data.labels.indexOf(studentName);
            if(index == -1) {
                index = studentActivityChart.data.labels.length;
            }
            studentActivityChart.data.labels[index] = studentName;
            studentActivityChart.data.datasets[1].data[index] = lessonVisitsData[studentName];
        });


        studentActivityChart.update();
    });
    Livewire.on('updateCourseViewTime', (courseVisitsData, lessonVisitsData) => {

        studentActivityChart.data.labels = [];
        studentActivityChart.data.datasets[0].data = [];
        studentActivityChart.data.datasets[1].data = [];

        Object.keys(courseVisitsData).forEach(studentName => {
            let index = studentActivityChart.data.labels.indexOf(studentName);
            if(index == -1) {
                index = studentActivityChart.data.labels.length;
            }
            studentActivityChart.data.labels[index] = studentName;
            studentActivityChart.data.datasets[0].data[index] = courseVisitsData[studentName];
        });

        Object.keys(lessonVisitsData).forEach(studentName => {
            let index = studentActivityChart.data.labels.indexOf(studentName);
            if(index == -1) {
                index = studentActivityChart.data.labels.length;
            }
            studentActivityChart.data.labels[index] = studentName;
            studentActivityChart.data.datasets[1].data[index] = lessonVisitsData[studentName];
        });

        
        studentActivityChart.update();
    });
});
</script>
@endpush

@push('css')
<style>
    @media (max-width: 420px) {
        .chart {
            width: 100%;
        }

        .content_child {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }
</style>
@endpush