<div>
    <div class="card-header">
        <h4 class="mb-0">
            <span class="badge badge-pill badge-primary">{{ $step + 1 }}</span>
            {{ $question->question }}
        </h4>
    </div>
    <div class="card-body form">
        @foreach ($question->answers as $answer)
        {{-- <div class="form-check">
            <input wire:model="responses" class="form-check-input" type="checkbox" value="{{ $answer->id }}">
            {{ $answer->answer }}
        </div> --}}
        <div class="inputGroup">
            <input id="{{$answer->id}}" wire:model.defer="responses" type="checkbox" value="{{ $answer->id }}" />
            <label for="{{$answer->id}}">{{ $answer->answer }}</label>
        </div>
        @endforeach
    </div>
    <div class="row d-flex justify-content-center">
        @if(!$lastQuestion)
        <div wire:loading.class.remove="bg-primary" class="circle bg-primary" wire:click="goToNextQuestion">
            <div class="fa fa-long-arrow-right next p-3" id="nextquestion" style="cursor: pointer;"><i
                    class="fa fa-arrow-right" aria-hidden="true"></i>
            </div>
        </div>
        @endif
    </div>
</div>