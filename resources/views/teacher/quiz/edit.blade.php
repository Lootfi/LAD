@extends('layouts.app')

@section('title', 'Course Quiz - Edit')')

@section('breadcrumbs')
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
                <h3 class="text-white mb-0">Edit Quiz Information</h3>
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
<div class="row">
    <div class="col">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="text-white mb-0">Edit Quiz Questions & Answers</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('teacher.quiz.questions.update', [$course, $quiz]) }}">
                    @csrf
                    @method('PUT')
                    @foreach ($quiz->questions as $question)
                    <div class="form-group">
                        <label class="form-control-label" for="input-question">{{ __('Question') }}</label>
                        <input type="text" name="question[]" id="input-question"
                            class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Question') }}" value="{{ old('question', $question->question) }}"
                            required autofocus>

                        @if ($errors->has('question'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('question') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-answer">{{ __('Answer') }}</label>
                        <input type="text" name="answer[]" id="input-answer"
                            class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Answer') }}" value="{{ old('answer', $question->answer) }}" required
                            autofocus>

                        @if ($errors->has('answer'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('answer') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endforeach
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection