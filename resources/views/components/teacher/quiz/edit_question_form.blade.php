<div class="row">
    <div class="col">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="mb-0">Edit Question</h3>
            </div>
            <div class="card-body">
                <form id="question-{{$question->id}}" method="POST"
                    action="{{ route('teacher.question.update', ['quiz' => $quiz, 'question' => $question]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-question">{{ __('Question') }}</label>
                        <input type="text" name="question" id="input-question"
                            class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Question') }}" value="{{ old('question', $question->question) }}"
                            required autofocus>

                        @if ($errors->has('question'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('question') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{-- a form group with all possible question's answers, and a toggle for right_answer --}}
                    <label class="form-control-label mt-4" for="input-answer">{{ __('Answers') }}</label>

                    @foreach ($question->answers as $answer)
                    <x-teacher.quiz.edit_answer_form :answer="$answer" />
                    @endforeach

                    {{-- selecting kcs for this question --}}
                    <x-teacher.quiz.edit_kcs_form :question="$question" />
                    {{-- button that creates a new input group for a new answer in a modal --}}
                    <div class="text-center">
                        <button type="button" class="btn btn-success mt-4" data-toggle="modal"
                            data-target="#add-answer-modal-{{$question->id}}">{{ __('Add A New Answer') }}</button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>