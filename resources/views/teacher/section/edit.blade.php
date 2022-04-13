@extends('adminlte::page')

@section('title', 'Edit Section')

@section('content_header')
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.show', ['course' => auth()->user()->teaches]) }}">{{$course->title}}</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.section.index', $course) }}">Sections</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.section.show', [$course,$section]) }}">{{$section->name}}</a>
</li>
<li class="breadcrumb-item active">Edit</li>

@endsection

@section('content')
{{-- teacher edits section information --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Section Information</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('teacher.course.section.update', [$course, $section]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$section->name}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{$section->description}}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option @if ($section->status == 1)
                        selected
                        @endif
                        value="1" {{$section->status == 'active' ? 'selected' : ''}}>Active</option>
                    <option @if ($section->status == 0)
                        selected
                        @endif
                        value="0" {{$section->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection