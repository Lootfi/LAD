@extends('adminlte::page')

@section('title', 'Edit Lesson')


@section('content_header')
<h1>Edit Lesson</h1>
@stop


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Lesson</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST"
                action="{{ route('teacher.course.section.lesson.update', ['course' => $course, 'section' => $section, 'lesson' => $lesson]) }}">
                @csrf
                @method('PUT')
                <div class="box-body">
                    {{-- title --}}
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Title"
                            value="{{ $lesson->name }}">
                    </div>
                    {{-- /title --}}
                    {{-- description --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Enter Description">{{ $lesson->description }}</textarea>
                    </div>
                    {{-- /description --}}
                    {{-- status --}}
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" {{ $lesson->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $lesson->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    {{-- /status --}}
                    {{-- kcs --}}
                    @include('teacher.kc.partials.select', ['editForm' => true, 'model' => $lesson])
                    {{-- /kcs --}}
                    {{-- content --}}
                    <div class="form-group">
                        <label for="lesson_content">Lesson</label>
                        <input type="hidden" name="content" id="lesson_content" value="{{$lesson->content}}" />
                        <trix-editor input="lesson_content" class="trix-content"></trix-editor>
                    </div>
                    {{-- /content --}}
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection