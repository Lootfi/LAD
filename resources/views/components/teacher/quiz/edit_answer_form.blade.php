<div class="form-group" name="answers" id="{{$answer->id}}">
    {{-- fancy checkbox for right_answer, allow user to change right_answer --}}
    {{-- <div class="custom-control custom-checkbox mb-3">
        <input type="checkbox" name="right-answers[]" class="custom-control-input" id="right-answer-{{ $answer->id }}"
            value="{{ $answer->id }}" {{ $answer->right_answer ?
        'checked' : '' }}>
        <label class="custom-control-label" for="right-answer-{{ $answer->id }}">{{ __('Correct
            Answer') }}</label>
    </div> --}}

    {{-- answer --}}
    {{-- <input type="text" name="answers[{{ $answer->id }}]" id="answer-{{ $answer->id }}"
        class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
        placeholder="{{ __('Answer') }}" value="{{ old('answer', $answer->answer) }}" required autofocus>
    --}}


    <div class="input-group mb-3" id="answer-wrapper-{{ $answer->id }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                {{-- checkbox, with onclick --}}

                <input class="answer-checkbox" type="checkbox" name="right-answers[]"
                    id="right-answer-{{ $answer->id }}" value="{{ $answer->id }}" {{ $answer->right_answer ? 'checked' :
                '' }}
                aria-label="Checkbox for answer" onclick="updateRightAnswer({{ $answer->id }})" />
            </div>
        </div>
        {{-- answer input --}}
        <input type="text" name="answers[{{ $answer->id }}]" id="answer-{{ $answer->id }}"
            class="answer-input form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Answer') }}" value="{{ old('answer', $answer->answer) }}" required autofocus
            aria-label="Text input for answer">
    </div>

    @if ($errors->has('answer'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('answer') }}</strong>
    </span>
    @endif
</div>