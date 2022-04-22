<div>
    {{-- ul sortable, unstyled ul --}}
    <ul class="list-group" id="drag-group">
        @foreach ($questions as $question)
        <li order="{{$question['order']}}" id="{{$question['id']}}" draggable="true" class="list-group-item drag-item">
            {{$question['question']}}</li>
        @endforeach
    </ul>
</div>