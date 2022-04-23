@extends('adminlte::page')

@section('title', 'KC ('. $kc->name . ') - Show')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.course.show', $course) }}">{{$course->name}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('teacher.kc.manage', $course) }}">KCs</a></li>
<li class="breadcrumb-item active">KC ({{$kc->name}}) - Show</li>
@endsection

@section('content')
<div class="container-fluid mt--7">

    <h4 class="text-uppercase ls-1 mb-3">KC Lessons</h4>

    <div class="row">
        <livewire:teacher.kc.lessons :kc="$kc" :lessonids="$lessonIds" />
    </div>

    <h4 class="text-uppercase ls-1 mt-5 mb-3">KC Questions</h4>

    <div class="row">
        <livewire:teacher.kc.questions :kc="$kc" :questionids="$questionIds" />
    </div>

</div>
@endsection