<div>
    <div class="btn-group" role="group" aria-label="Basic example">
        @foreach ($quiz->questions as $question)
        <button wire:click="clickQuestion({{$question->id}})" type="button"
            class="btn {{in_array($question->id, $this->selected_questions) ? 'btn-primary' : 'btn-secondary'}}">#Q{{$question->order}}</button>
        @endforeach
    </div>
</div>