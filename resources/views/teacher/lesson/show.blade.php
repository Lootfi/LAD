@extends('adminlte::page')

@section('title', 'Show Lesson')


@section('content_header')
<h1>Show Lesson</h1>
@stop


@section('content')
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