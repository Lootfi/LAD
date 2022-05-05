<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Students Lessons Views</h3>
            </div>
            <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Lesson</th>
                    <th scope="col">Visits</th>
                    <th scope="col">Students</th>
                    <th scope="col">Last Week Change</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons_visits as $lesson_id => $lesson)
                <tr>
                    <th scope="row">
                        <a
                            href="{{ route('teacher.course.section.lesson.show', ['course' => $course, 'section' => $lesson['section_id'], 'lesson' => $lesson_id]) }}">{{$lesson['name']}}</a>
                    </th>
                    <td>
                        {{$lesson['visits']}}
                    </td>
                    <td>
                        {{-- {{$lesson['unique_students']}} --}}
                        <div class="avatars">
                            @foreach ($lesson['students'] as $student)
                            <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                title="{{$student['name']}}">
                                <img class="avatar" alt="Image placeholder" src="{{ $student['avatar'] }}">
                            </a>
                            @if ($loop->iteration == 4)
                            @break
                            @endif
                            @endforeach
                            @if (count($lesson['students']) > 4)
                            <a href="#" class="avatars-item">
                                <img class="avatar" alt="+{{count($lesson['students']) - 4}}" src="">
                            </a>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if ($lesson['since_last_week'] > 0)
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i> <span
                            class="ml-1 text-success">+{{$lesson['since_last_week']}}%</span>
                        @elseif ($lesson['since_last_week'] < 0) <i class="fa fa-arrow-down text-danger"
                            aria-hidden="true"></i> <span
                                class="ml-1 text-danger">{{$lesson['since_last_week']}}%</span>
                            @else
                            <b class="text-secondary">∅</b> <span class="ml-1 text-secondary">+0%</span>
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('js')
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush