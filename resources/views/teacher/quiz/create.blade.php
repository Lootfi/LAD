@extends('layouts.app')

@section('title', 'Create Quiz')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('teacher.quiz.index', ['course' => auth()->user()->teaches]) }}">Quiz</a>
</li>
<li class="breadcrumb-item active">Create</li>

@endsection

@section('content')

{{-- //create a quiz form --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Quiz') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.quiz.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="quiz_name" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Name')
                                }}</label>

                            <div class="col-md-6">
                                <input id="quiz_name" type="text"
                                    class="form-control @error('quiz_name') is-invalid @enderror" name="quiz_name"
                                    value="{{ old('quiz_name') }}" required autocomplete="quiz_name" autofocus>

                                @error('quiz_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quiz_description" class="col-md-4 col-form-label text-md-right">{{ __('Quiz
                                Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="quiz_description"
                                    class="form-control @error('quiz_description') is-invalid @enderror"
                                    name="quiz_description" value="{{ old('quiz_description') }}" required
                                    autocomplete="quiz_description" autofocus></textarea>

                                @error('quiz_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        < @endsection