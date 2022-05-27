<div>
    <div id="timeLeft"></div>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">

            <div class="col-xl-7 col-lg-8 col-md-9 d-flex">
                @foreach ($quiz->questions as $key => $question)
                <div class="w-100 b-0 {{ $active_question->id != $question->id ? 'd-none' : '' }}">
                    @livewire('student.quiz.question-step', ['question' => $question, 'step' => $key, 'lastQuestion' =>
                    $loop->last],
                    key($question->id))

                    <student.quiz.question-step :question="$question" :step="$key" lastQuestion="{{$loop->last}}" wire:key="{{$question->id}}" />
                </div>
                @endforeach
                <ul class="list-group mr-2">
                    @foreach ($quiz->questions as $key => $question)
                    {{-- rounded div --}}
                    <li wire:click="setActiveQuestion({{ $question->id }})" class="list-group-item {{ $question->id == $active_question->id ? 'active' : '' }}">
                        <span>{{ $key + 1 }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <<<<<<< HEAD <br>
        <button wire:click="submitQuiz" class="btn btn-danger">
            Submit Quiz and See results
        </button>
        =======
        <!-- <br> -->
        <div class="col text-center">
            <button wire:click="submitQuiz" class="btn btn-danger ">
                Submit quiz and see results
            </button>
        </div>
</div>
>>>>>>> f5648a3 (some changes)



<div class="alert alert-success alert-dismissible fade" role="alert" id="alert"> {{-- fade or show--}}
    <pre id="alert-text"></pre>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


</div>

@once
@push('js')
<script src="https://momentjs.com/downloads/moment.min.js"></script>
@endpush
@endonce

@section('js')
<script defer>
    var countDownDate = moment('{{$quiz->end_date}}');

    var x = setInterval(function() {
        diff = countDownDate.diff(moment());

    }, 1000);
</script>

<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showEasing": "swing",
        "showMethod": "fadeIn",
        'timeOut': 0,
        'extendedTimeOut': 0,
    }

    Echo.channel(`quiz.@js($quiz->id).student.@js($student->id).kcs`)
        .listen('Student\\QuizKcAwarenessWarning', (e) => {
            toastr.info(e.message, "Teacher Notification!")
        });
</script>

{{-- <script>
    // 'quiz.' . $this->quiz->id . '.student.' . $this->student->id . 'kcs'
    Echo.channel(`quiz.@js($quiz->id).student.@js($student->id).kcs`)
        .listen('Student/QuizKcAwarenessWarning', (e) => {
            console.log(e);
        });
</script> --}}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/quiz-answer.css') }}">
@endpush