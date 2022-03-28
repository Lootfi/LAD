<div class="modal fade" id="add-question-modal-{{$quiz->id}}" tabindex="-1" role="dialog"
    aria-labelledby="add-question-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-question-modal-label">{{ __('Add Question') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('teacher.quiz.question.store', ['quiz' => $quiz]) }}">
                    @csrf
                    <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-question">{{ __('Question') }}</label>
                        <input type="text" name="question" id="input-question"
                            class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Question') }}" value="{{ old('question') }}" required autofocus>

                        @if ($errors->has('question'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('question') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{-- form-group to create a right answer right of the bat --}}
                    <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-right-answer">{{ __('Right Answer') }}</label>
                        <input type="text" name="answer" id="input-right-answer"
                            class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Right Answer') }}" value="{{ old('answer') }}" required>

                        @if ($errors->has('answer'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('answer') }}</strong>
                        </span>
                        @endif
                    </div>

                    {{-- <div class="form-group" name='answers'>
                        <label class="form-control-label" for="input-answer">{{ __('Answer') }}</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="right-answers[]" class="custom-control-input"
                                id="right-answer-1" value="1" checked>
                            <label class="custom-control-label" for="right-answer-1">{{ __('Correct Answer') }}</label>
                        </div>
                    </div>
                    --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>