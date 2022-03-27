@extends('adminlte::page')

@section('title', 'Course Quiz - Edit')

@section('content_header')
{{-- quizzes breadcrumb item with link --}}
<li class="breadcrumb-item">
    <a href="{{ route('teacher.quiz.index', $course) }}">Quizzes</a>
</li>

{{-- edit quiz breadcrumb item --}}
<li class="breadcrumb-item active">Edit Quiz</li>
@endsection

@section('content')
{{-- edit quiz form --}}
<div class="row">
    <div class="col">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="mb-0">Edit Quiz Information</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('teacher.quiz.update', [$course, $quiz]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="input-name"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Name') }}" value="{{ old('name', $quiz->name) }}" required autofocus>

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-start_date">{{ __('Start Date') }}</label>
                        <input type="date" name="start_date" id="input-start_date"
                            class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Start Date') }}" value="{{ old('start_date', $quiz->start_date) }}"
                            required autofocus>

                        @if ($errors->has('start_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{-- edit duration --}}
                    <div class="form-group{{ $errors->has('duration') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-duration">{{ __('Duration (in minutes)') }}</label>
                        <input type="number" name="duration" id="input-duration"
                            class="form-control form-control-alternative{{ $errors->has('duration') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Duration') }}" value="{{ old('duration', $quiz->duration) }}" required
                            autofocus>

                        @if ($errors->has('duration'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('duration') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{-- quiz description --}}
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                        <textarea name="description" id="input-description"
                            class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Description') }}" required
                            autofocus>{{ old('description', $quiz->description) }}</textarea>

                        @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- add some margin between two divs --}}
<div class="row">
    <div class="col-12"></div>
</div>



{{-- rows of forms to edit quiz questions with their answers --}}
{{-- foreach question, add a row with a form --}}
@foreach ($quiz->questions as $question)
<div class="row">
    <div class="col">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="mb-0">Edit Question</h3>
            </div>
            <div class="card-body">
                <form id="{{$question->id}}" method="POST"
                    action="{{ route('teacher.quiz.question.update', [$course, $quiz, $question]) }}">
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
                    @foreach ($question->answers as $answer)
                    <div class="form-group" name="answers" id="{{$answer->id}}">
                        <label class="form-control-label" for="input-answer">{{ __('Answer') }}</label>
                        {{-- fancy checkbox for right_answer, allow user to change right_answer --}}
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="right-answers[]" class="custom-control-input"
                                id="right-answer-{{ $answer->id }}" value="{{ $answer->id }}" {{ $answer->right_answer ?
                            'checked' : '' }}>
                            <label class="custom-control-label" for="right-answer-{{ $answer->id }}">{{ __('Correct
                                Answer') }}</label>
                        </div>

                        {{-- answer --}}
                        <input type="text" name="answers[{{ $answer->id }}]" id="answer-{{ $answer->id }}"
                            class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Answer') }}" value="{{ old('answer', $answer->answer) }}" required
                            autofocus>

                        @if ($errors->has('answer'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('answer') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endforeach
                    {{-- button that creates a new input group for a new answer in a modal --}}
                    <div class="text-center">
                        <button type="button" class="btn btn-success mt-4" data-toggle="modal"
                            data-target="#add-answer-modal">{{ __('Add A New Answer') }}</button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- add some margin between two divs --}}
<div class="row">
    <div class="col-12"></div>
</div>
@endforeach

{{-- button that takes whole width of screen: Add Question --}}
<div class="row">
    <div class="col">
        {{-- button 'Add Question', shows new modal --}}
        <button type="button" class="mb-5 btn btn-success btn-block" data-toggle="modal"
            data-target="#add-question-modal">{{
            __('Add New Question') }}</button>
    </div>
</div>

{{-- modal for adding new question --}}

{{-- add-question-modal --}}
<div class="modal fade" id="add-question-modal" tabindex="-1" role="dialog" aria-labelledby="add-question-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-question-modal-label">{{ __('Add Question') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('teacher.quiz.question.store', [$course, $quiz]) }}">
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
                    <div class="form-group" name='answers'>
                        <label class="form-control-label" for="input-answer">{{ __('Answer') }}</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="right-answers[]" class="custom-control-input"
                                id="right-answer-1" value="1" checked>
                            <label class="custom-control-label" for="right-answer-1">{{ __('Correct Answer') }}</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- add-answer-modal --}}
<div class="modal fade" id="add-answer-modal" tabindex="-1" role="dialog" aria-labelledby="add-answer-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-answer-modal-label">{{ __('Add Answer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('teacher.quiz.answer.store', [$course, $quiz, $question]) }}">
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
</div>


@endsection

@section('js')

@endsection