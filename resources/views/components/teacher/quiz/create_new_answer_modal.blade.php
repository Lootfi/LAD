<div class="modal fade" id="add-answer-modal-{{$question->id}}" tabindex="-1" role="dialog"
    aria-labelledby="add-answer-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-answer-modal-label">{{ __('Add Answer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('teacher.quiz.answer.store', ['quiz' => $quiz, 'question' => $question]) }}">
                    @csrf
                    <div class="form-group" name='answers'>
                        <label class="form-control-label" for="input-answer">{{ __('Answer') }}</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="right_answer" class="custom-control-input" id="right_answer"
                                value="1">
                            <label class="custom-control-label" for="right_answer">{{ __('Correct Answer') }}</label>
                        </div>
                    </div>
                    <input type="text" name="answer" id="answer"
                        class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Answer') }}" value="" required autofocus>

                    @if ($errors->has('answer'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                    @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>