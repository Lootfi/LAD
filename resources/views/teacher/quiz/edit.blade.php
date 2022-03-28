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
                        {{-- input for start date datetime_local dd/mm/yyyy--}}
                        <input type="datetime-local" name="start_date" id="input-start_date"
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

{{-- create new answer modal --}}

<x-teacher.quiz.create_new_answer_modal :question="$question" :quiz="$quiz" />

{{-- edit question row --}}
<x-teacher.quiz.edit_question_form :question="$question" :quiz="$quiz" />

{{-- edit answer row --}}

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
            data-target="#add-question-modal-{{$quiz->id}}">{{
            __('Add New Question') }}</button>
    </div>
</div>

{{-- modal for adding new question --}}

{{-- add-question-modal --}}

<x-teacher.quiz.create_new_question_modal :quiz="$quiz" />





@endsection

@section('js')
<script>
    var updateRightAnswer;
    // when page is reloaded, scroll to question's id in url (if exists) or to the top of the page (if not)
    $(document).ready(function () {
        // get question_id from url paramaters (if exists)
        var question_id = new URLSearchParams(window.location.search).get('question_id')
        console.log(question_id);
        if (question_id) {

            document.getElementById('question-' + question_id).scrollIntoView({
            behavior: 'auto',
            block: 'center',
            inline: 'center',
            behavior: 'smooth',
        });
            
        }

        updateRightAnswer = function (elementId) {
        let el = document.getElementById("answer-wrapper-" + elementId);
        el.classList.add("border","border-success");
    }
    });

</script>
@endsection