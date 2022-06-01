<table class="w-100 table table-stripped text-center">
    <thead class="thead-dark">
        <tr>
            <th>
                Log
            </th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logs as $log)
        <tr style="background-color: {{$loop->index % 2 == 0 ? 'rgba(0,0,0,.05);' : ''}}">
            <td>
                {{
                $log->description
                }}
                @if($log->subject_type == 'App\Models\QuizResponse')
                #{{$log->properties['attributes']['question_id']}}
                @if ($log->correct)
                <b class="text-success">(Correct)</b>
                @else
                <b class="text-danger">(Incorrect)</b>
                @endif
                @endif
            </td>
            <td>
                {{
                $log->created_at->diffForHumans([
                'parts' => 2,
                'join' => true,
                ])
                }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2" class="text-center py-5 text-muted">No Logs</td>
        </tr>
        @endforelse
    </tbody>
</table>