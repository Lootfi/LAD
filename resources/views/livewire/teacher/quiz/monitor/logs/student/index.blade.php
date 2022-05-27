<table class="w-100">
    <tr>
        <th>
            Log
        </th>
        <th>Date</th>
    </tr>
    @foreach ($logs as $log)
    <tr style="background-color: {{$loop->index % 2 == 0 ? 'rgba(0,0,0,.05);' : ''}}">
        <td>
            {{
            $log->description
            }}
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
    @endforeach
</table>