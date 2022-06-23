<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Students Lessons Views</h3>
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
                            <div class="avatars-item" data-toggle="tooltip" data-placement="top"
                                title="{{$student['name']}}" style="cursor: ">
                                <img class="avatar" alt="Image placeholder" src="{{ $student['avatar'] }}">
                            </div>
                            @if ($loop->iteration == 4)
                            @break
                            @endif
                            @endforeach
                            @if (count($lesson['students']) > 4)
                            <a class="avatars-item" data-toggle="modal"
                                data-target="#students-who-visited-{{$lesson_id}}">
                                <img class="avatar" alt="+{{count($lesson['students']) - 4}}" src="">
                            </a>

                            <div class="modal fade" id="students-who-visited-{{$lesson_id}}" tabindex="-1" role="dialog"
                                aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students who
                                                visited lesson') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($lesson['students'] as $student)
                                            {{-- list of students with avatars --}}
                                            <div class="d-flex flex-direction-row pb-3">
                                                <a href="#" class="avatars-item" data-toggle="tooltip"
                                                    data-placement="top" title="{{$student['name']}}">
                                                    <img class="avatar" alt="Image placeholder"
                                                        src="{{ $student['avatar'] }}">
                                                </a>
                                                <span>{{$student['name']}}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
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