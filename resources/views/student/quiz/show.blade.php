@extends('adminlte::page')

@section('title', $quiz->name)

@section('content_header')
{{-- link to index quizzes page --}}
<a href="{{ route('student.quiz.index', ['course' => $quiz->course]) }}" class="breadcrumb-item">Quizzes</a>
<p class="breadcrumb-item">{{$quiz->name}}</p>
@stop

@section('content')

<livewire:student.quiz-page :quiz="$quiz" />

@endsection

@section('js')
{{-- make the carbon time left date a dynamic countdown --}}
<script>
    var timeLeft = "{{Carbon\Carbon::parse($quiz->start_date)->diffForHumans(['parts' => 6])}}";
    var timeLeftDate = "{{Carbon\Carbon::parse($quiz->start_date)->toDateTimeString()}}";

    console.log(timeLeft, timeLeftDate);

    // set the countdown from now to the start date of the quiz
    var countdown = new Date(timeLeftDate).getTime();



</script>
@endsection