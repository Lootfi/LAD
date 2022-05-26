<div>
    <div class="row justify-content-end">
        {{-- refresh button fontawesome --}}
        <button wire:click="refreshData" class="btn btn-sm btn-outline-primary bg-success refresh-button">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>
    <table class="table">
        <tr style="background-color: rgba(0,0,0,.05);">
            <th>{{$students_online->count()}} Students Online</th>
            <td class="avatars">

                @foreach ($students_online as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_online) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_online">
                    <img class="avatar" alt="+{{count($students_online) - 4}}" src="">
                </a>

                <div class="modal fade" id="students_online" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students online') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_online as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @endif

            </td>

            <th>{{$students_passing_quiz_in_last_x->count()}} Students Passing Quiz In Last Day</th>
            <td class="avatars">
                @foreach ($students_passing_quiz_in_last_x as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_passing_quiz_in_last_x) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_passing_quiz_in_last_x">
                    <img class="avatar" alt="+{{count($students_passing_quiz_in_last_x) - 4}}" src="">
                </a>

                <div class="modal fade" id="students_passing_quiz_in_last_x" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students who passed quiz
                                    in
                                    last day') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_passing_quiz_in_last_x as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @endif
            </td>

        </tr>
        <tr>
            <th>{{$students_struggling->count()}} Students Struggling</th>
            <td class="avatars">
                @foreach ($students_struggling as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_struggling) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_struggling">
                    <img class="avatar" alt="+{{count($students_struggling) - 4}}" src="">
                </a>

                <div class="modal fade" id="students_struggling" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students who are
                                    struggling')
                                    }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_struggling as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                @endif
            </td>

            <th>{{$students_with_perfect_score->count()}} Students With Perfect Score</th>
            <td class="avatars">
                @foreach ($students_with_perfect_score as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_with_perfect_score) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_with_perfect_score">
                    <img class="avatar" alt="+{{count($students_with_perfect_score) - 4}}" src="">
                </a>


                <div class="modal fade" id="students_with_perfect_score" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students with a perfect
                                    score') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_with_perfect_score as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                @endif
            </td>

        </tr>
        </tr>
        <tr style="background-color: rgba(0,0,0,.05);">
            <th>{{$students_with_all_wrong_answers->count()}} Students With All Answers Wrong</th>
            <td class="avatars">
                @foreach ($students_with_all_wrong_answers as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_with_all_wrong_answers) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_with_all_wrong_answers">
                    <img class="avatar" alt="+{{count($students_with_all_wrong_answers) - 4}}" src="">
                </a>



                <div class="modal fade" id="students_with_all_wrong_answers" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __('All students with all
                                    responses
                                    wrong') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_with_all_wrong_answers as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                @endif
            </td>

            <th>{{$students_who_havent_started_quiz_yet->count()}} Students Who Haven't started Quiz Yet</th>
            <td class="avatars">
                @foreach ($students_who_havent_started_quiz_yet as $student)
                <a href="{{ route('teacher.quiz.monitor.student', [
                'course' => $quiz->course,
                'quiz' => $quiz,
                'student' => $student
            ]) }}" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
                    <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                </a>
                @if ($loop->iteration == 4)
                @break
                @endif
                @endforeach
                @if (count($students_who_havent_started_quiz_yet) > 4)
                <a class="avatars-item" data-toggle="modal" data-target="#students_who_havent_started_quiz_yet">
                    <img class="avatar" alt="+{{count($students_who_havent_started_quiz_yet) - 4}}" src="">
                </a>


                <div class="modal fade" id="students_who_havent_started_quiz_yet" tabindex="-1" role="dialog"
                    aria-labelledby="students-who-visited-lesson-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-answer-modal-label">{{ __("All students who haven't
                                    started
                                    the quiz yet") }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($students_who_havent_started_quiz_yet as $student)
                                {{-- list of students with avatars --}}
                                <div class="d-flex flex-direction-row pb-3">
                                    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                                        title="{{$student->name}}">
                                        <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                                    </a>
                                    <span>{{$student->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>



                @endif
            </td>

        </tr>
        </tr>
    </table>
</div>


@section('css')
<style>
    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: none;
    }

    .refresh-button {
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        font-size: 14px;
        position: relative;
        border: none;
        color: #fff;
        padding: 10px;
        width: 50px;
        text-align: center;
        transition-duration: 0.4s;
        overflow: hidden;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .refresh-button:hover {
        background: #fff;
        box-shadow: 0px 2px 10px 5px #1abc9c;
        color: #000;
    }

    .refresh-button:after {
        content: "";
        background: #1abc9c;
        display: block;
        position: absolute;
        padding-top: 300%;
        padding-left: 350%;
        margin-left: -20px !important;
        margin-top: -120%;
        opacity: 0;
        transition: all 0.8s
    }

    .refresh-button:active:after {
        padding: 0;
        margin: 0;
        opacity: 1;
        transition: 0s
    }

    .refresh-button:focus {
        outline: 0;
    }
</style>
@endsection