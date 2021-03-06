@extends('adminlte::page')

@section('title', 'Create Quiz')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.quiz.index', ['course' => auth()->user()->teaches]) }}">Quiz</a>
</li>
<li class="breadcrumb-item active">Create</li>

@endsection

@section('content')

{{-- create a quiz form --}}
<form action="{{ route('teacher.quiz.store', ['course' => auth()->user()->teaches]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="name" placeholder="Enter title" required
            value="{{ old('name') }}">
        {{-- errors --}}

        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"
            required>{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="start_date">Start Date</label>
        {{-- input for start date datetime_local dd/mm/yyyy--}}
        <input type="datetime-local" class="form-control" id="start_date" name="start_date" required
            value="{{old('start_date')}}">
        {{-- errors --}}
        @error('start_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="time_limit">Time Limit (mins)</label>
        <input type="number" class="form-control" id="time_limit" name="duration" placeholder="Enter time limit"
            required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>


@endsection