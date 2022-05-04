<div>
    <div class="btn-group" role="group" aria-label="Basic example">
        @foreach ($quiz->questions as $question)
        <button type="button" class="btn btn-secondary">#Q{{$question->order}}</button>
        @endforeach
    </div>
</div>