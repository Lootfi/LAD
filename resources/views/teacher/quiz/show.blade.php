@extends('adminlte::page')

@section('title', 'Course Quiz')

@section('content_header')
<li class="breadcrumb-item">
    <a href="{{ route('teacher.quiz.index', $course) }}">Quizzes</a>
</li>
<li class="breadcrumb-item active">{{$quiz->name}}</li>
@endsection

@section('content')

{{-- show quiz information in bootstrap card element --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$quiz->name}}</h3>
        {{-- edit and delete buttons --}}
        <div class="card-tools">
            <a href="{{ route('teacher.quiz.monitor', ['course' => $course, 'quiz' => $quiz]) }}"
                class="btn btn-sm btn-info">
                <i class="fas fa-chart-line"></i>
                Monitor
            </a>
            </a>
            @if ($quiz->status == "upcoming")
            <a href="{{ route('teacher.quiz.edit', [$course, $quiz]) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
                Edit
            </a>
            @else
            <button class="btn btn-sm btn-primary" disabled>
                <i class="fas fa-edit"></i>
                Edit
            </button>
            @endif
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash"></i>
                Delete
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{$quiz->name}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" value="{{$quiz->description}}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" value="{{$quiz->start_date}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" value="{{$quiz->end_date}}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="time_limit">Time Limit</label>
                    <input type="text" class="form-control" id="time_limit" value="{{$quiz->duration}} minutes"
                        disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pass_percentage">Pass Percentage</label>
                    <input type="text" class="form-control" id="pass_percentage" value="{{$quiz->pass_percentage}}"
                        disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" value="{{$quiz->status}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <input type="text" class="form-control" id="course_id" value="{{$course->title}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- delete confirmation modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this quiz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('teacher.quiz.destroy', [$course, $quiz]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection