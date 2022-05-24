<table class="table">
    <tr>
        <th>{{$students_online->count()}} Students Online</th>
        <td class="avatars">

            @foreach ($students_online as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif

        </td>

        <th>{{$students_passing_quiz_in_last_x->count()}} Students Passing Quiz In Last Day</th>
        <td class="avatars">
            @foreach ($students_passing_quiz_in_last_x as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif
        </td>

    </tr>
    <tr>
        <th>{{$students_struggling->count()}} Students Struggling</th>
        <td class="avatars">
            @foreach ($students_struggling as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif
        </td>

        <th>{{$students_with_perfect_score->count()}} Students With Perfect Score</th>
        <td class="avatars">
            @foreach ($students_with_perfect_score as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif
        </td>

    </tr>
    </tr>
    <tr>
        <th>{{$students_with_all_wrong_answers->count()}} Students With All Answers Wrong</th>
        <td class="avatars">
            @foreach ($students_with_all_wrong_answers as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif
        </td>

        <th>{{$students_who_havent_started_quiz_yet->count()}} Students Who Haven't started Quiz Yet</th>
        <td class="avatars">
            @foreach ($students_who_havent_started_quiz_yet as $student)
            <a href="" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
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
            @endif
        </td>

    </tr>
    </tr>
</table>