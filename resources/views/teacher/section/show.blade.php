@extends('adminlte::page')

@section('title', 'Course Section: '. $section->name)

{{-- content_header --}}
@section('content_header')
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.show', ['course' => auth()->user()->teaches]) }}">Course</a>
</li>
<li class="breadcrumb-item">
    <a href="#">{{ $course->title }}</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.section.index', $course) }}">Sections</a>
</li>
<li class="breadcrumb-item active">{{$section->name}}</li>

@endsection

@section('content')
{{-- show section information in bootstrap card element --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$section->name}}</h3>
        <div class="card-tools">
            <a href="{{ route('teacher.course.section.edit', [$course, $section]) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i>
                Edit
            </a>
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
                    <input type="text" class="form-control" id="name" value="{{$section->name}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" value="{{$section->description}}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" value="{{$section->status}}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="created_at">Created At</label>
                    <input type="text" class="form-control" id="created_at" value="{{$section->created_at}}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="updated_at">Updated At</label>
                    <input type="text" class="form-control" id="updated_at" value="{{$section->updated_at}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- show section lessons --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lessons</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="{{ route('teacher.course.section.lesson.create', [$course, $section]) }}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                        Add Lesson
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <livewire:teacher.lesson.table :section="$section" />

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
                Are you sure you want to delete this section?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('teacher.course.section.destroy', [$course, $section]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection