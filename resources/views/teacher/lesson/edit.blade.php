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
                action="{{ route('teacher.course.section.lesson.update-content', ['course' => $course, 'section' => $section, 'lesson' => $lesson]) }}">
                @csrf
                @method('PUT')
                <input name="content" id="lesson_content" value="{!! $lesson->content->toTrixHtml() !!}"
                    type="hidden" />
                <trix-editor input="lesson_content" class="trix-content"></trix-editor>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection