<div>
    <div class="card-header">
        <h4 class="mb-0">
            <span class="badge badge-pill badge-primary">{{ $step }}</span>
            {{ $question->question }}
        </h4>
    </div>
    <div class="card-body">
        @foreach ($question->answers as $answer)
        <div class="form-check">
            <input wire:model="responses" class="form-check-input" type="checkbox" value="{{ $answer->id }}">
            {{ $answer->answer }}
        </div>
        @endforeach
        Answers: {{ var_export($responses) }}
    </div>
    <div class="row d-flex justify-content-center">
        <div class="circle" wire:click="goToNextQuestion">
            <div class="fa fa-long-arrow-right next" id="nextquestion"><i class="fa fa-arrow-right"
                    aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>