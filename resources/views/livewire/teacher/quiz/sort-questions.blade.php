<div>
    {{-- ul sortable, unstyled ul --}}
    <ul class="list-group">
        @foreach ($quiz->questions as $question)
        <li draggable="true" class="list-group-item">{{$question->question}}</li>
        @endforeach
    </ul>
</div>