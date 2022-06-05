@extends('adminlte::page')

@section('title', 'Create Lesson')

@section('content_header')
<li class="breadcrumb-item"><a
                href="{{ route('teacher.course.section.show', ['course' => $course, 'section' => $section]) }}">Section:
                {{$section->name}}</a>
<li class="breadcrumb-item active">Create Lesson</li>
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" method="POST"
                                action="{{ route('teacher.course.section.lesson.store', ['course' => $course, 'section' => $section]) }}">
                                @csrf
                                <div class="box-body">
                                        {{-- title --}}
                                        <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter Title" value="Lesson Name">
                                        </div>
                                        {{-- /title --}}
                                        {{-- description --}}
                                        <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                        rows="3" placeholder="Enter Description"></textarea>
                                        </div>
                                        {{-- /description --}}
                                        {{-- status --}}
                                        <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                </select>
                                        </div>
                                        {{-- /status --}}
                                        {{-- kcs --}}
                                        @include('teacher.kc.partials.select', ['editForm' => false])
                                        {{-- /kcs --}}
                                        {{-- content --}}
                                        <label for="lesson_content">Lesson</label>
                                        <input name="content" id="lesson_content" type="hidden" />
                                        <trix-editor input="lesson_content" class="trix-content"></trix-editor>
                                        {{-- /content --}}
                                </div>
                                <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                        </form>
                </div>
        </div>
</div>
@endsection