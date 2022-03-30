@extends('adminlte::page')

{{-- header content --}}
@section('title', 'Dashboard')
@section('content_header')
<h1>Dashboard</h1>
@stop

{{-- main content --}}
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">My Teachers</span>
                <span class="info-box-number">{{ $total_teachers ?? 'help' }}</span>
            </div>
        </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">My Courses</span>
                <span class="info-box-number">{{ $total_courses ?? 'help' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-question"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">My Quizzes</span>
                <span class="info-box-number">{{ $total_assignments ?? 'help' }}</span>
            </div>
        </div>
    </div>
</div>
@stop