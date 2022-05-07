<table>
    <tr>
        <th>Students Online</th>
        <td>{{$students_online->count()}}</td>
        <th>Students Passing Quiz In Last Day</th>
        <td>{{$students_passing_quiz_in_last_x->count()}}</td>
    </tr>
    <tr>
        <th>Students Struggling</th>
        <td>{{$students_struggling->count()}}</td>
        <th>Students With Perfect Score</th>
        <td>{{$students_with_perfect_score->count()}}</td>
    </tr>
    </tr>
    <tr>
        <th>Students With All Answers Wrong</th>
        <td>{{$students_with_all_wrong_answers->count()}}</td>
        <th>Students Who Haven't started Quiz Yet</th>
        <td>{{$students_who_havent_started_quiz_yet->count()}}</td>
    </tr>
    </tr>
</table>