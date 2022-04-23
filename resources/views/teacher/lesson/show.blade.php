@extends('adminlte::page')

@section('title', 'Show Lesson')


@section('content_header')
<h1>Show Lesson</h1>
@stop


@section('content')
<div class="row">
    <div class="col-xl-8 mb-5 mb-xl-0">
        <livewire:teacher.lesson.cards.graphs.students-activity :lesson="$lesson" />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Show Lesson</h3>
            </div>
            {!! $lesson->content !!}
        </div>
    </div>
</div>
@endsection