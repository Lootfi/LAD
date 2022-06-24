@extends('adminlte::page')

@section('title', 'Course')

@section('content_header')
<li class="breadcrumb-item">Course</li>
@endsection

@section('content')

<div class="mt--7">

    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <livewire:teacher.course.cards.graphs.students-activity />
        </div>
        <div class="col-xl-4">
            <livewire:teacher.course.cards.students-online />
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-6">
            <livewire:teacher.course.cards.lesson-visits />
        </div>
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Course Feedback</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body mx-3 my-2">
                    @comments(['model' => $course, 'perPage' => 3])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection