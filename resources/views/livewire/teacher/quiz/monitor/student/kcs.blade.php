<div>
    <div>
        <div class="row">
            <h6 class="ml-1">Knowledge Components Awareness: </h6>
        </div>
        <div class="row">
            @foreach ($kcs as $kc_id => $kc_name)
            @if ($kcs_awareness[$kc_id] == -1)
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-secondary mr-1 mt-1">{{$kc_name}}</a>
            @elseif ($kcs_awareness[$kc_id] == 0)
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-danger mr-1 mt-1">{{$kc_name}}</a>
            @else
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-success mr-1 mt-1">{{$kc_name}}</a>
            @endif
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">

                    <button type="button" class="btn btn-danger" wire:click="notify" @if (in_array(-1, $kcs_awareness)
                        || in_array(0, $kcs_awareness)) @else disabled @endif data-toggle="tooltip" data-placement="top"
                        data-title="Notify the student of the KCs he is unaware of">
                        <i class=" fas fa-bell"></i>
                        Notify
                    </button>
                    <a href="{{ route('teacher.quiz.monitor.student.message', ['course' => $quiz->course, 'quiz' => $quiz, 'student' => $student]) }}"
                        target="_blank" rel="noopener noreferrer" class="btn btn-secondary" data-toggle="tooltip"
                        data-placement="top" data-title="Send a custom Notification">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>