@extends('adminlte::page')

@section('title', $quiz->name)

@section('content_header')
{{-- link to index quizzes page --}}
<a href="{{ route('student.quiz.index', ['course' => $quiz->course]) }}" class="breadcrumb-item">Quizzes</a>
<p class="breadcrumb-item">{{$quiz->name}}</p>
@stop

@section('content')

@if($quiz->is_active)
<div>
    <h1>{{$quiz->name}}</h1>

    {{-- show quiz description --}}
    <p>{{$quiz->description}}</p>

    {{-- show quiz start_date --}}
    <p>Start time: {{$quiz->start_date}}</p>

    {{-- show quiz duration --}}
    <p>Duration: {{$quiz->duration}} minutes</p>
</div>

{{-- else --}}
@else

<hr>
<h1>livewire part</h1>
<livewire:quiz-countdown-timer :quiz="$quiz" />
<hr>


<h1>Not yet</h1>

{{-- show time left --}}
{{-- time left is a countdown --}}
<p>Time left: {{Carbon\Carbon::parse($quiz->start_date)->diffForHumans(['parts' => 6])}}</p>
<p>Start Date: {{$quiz->start_date}}</p>
<p>Now: {{now()}}</p>
@endif

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