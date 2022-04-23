<div>
    <span wire:poll="checkTime"></span>
    <div wire:ignore id="timeLeft"></div>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">

            <div class="col-xl-7 col-lg-8 col-md-9 d-flex">
                @foreach ($quiz->questions as $key => $question)
                <div class="card b-0 {{ $active_question->id != $question->id ? 'd-none' : '' }}">
                    @livewire('student.quiz.question-step', ['question' => $question, 'step' => $key, 'lastQuestion' =>
                    $loop->last],
                    key($question->id))
                </div>
                @endforeach
                <ul class="list-group mr-2">
                    @foreach ($quiz->questions as $key => $question)
                    {{-- rounded div --}}
                    <li wire:click="setActiveQuestion({{ $question->id }})"
                        class="list-group-item {{ $question->id == $active_question->id ? 'active' : '' }}">
                        <span>{{ $key + 1 }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <br>
    <button wire:click="submitQuiz" class="btn btn-primary">
        Finish Quiz
    </button>


    {{-- finish quiz confirmation modal --}}
    {{-- <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="finishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Finish Quiz and Submit</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this quiz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    --}}
</div>

@once
@push('js')
<script src="https://momentjs.com/downloads/moment.min.js"></script>
@endpush
@endonce

@push('js')
<script defer>
    var countDownDate = moment('{{$quiz->end_date}}');

    var x = setInterval(function() {
        diff = countDownDate.diff(moment());
    
        if (diff <= 0) {
          clearInterval(x);
           // If the count down is finished, write some text 
          $('#timeLeft').text("EXPIRED");
        } else
          $('#timeLeft').text("Time Left: " + moment.utc(diff).format("HH:mm:ss"));

      }, 1000);

    // setInterval(() => {
    //         // document.getElementById('timeLeft').innerHTML = moment().format('dddd');
    //         document.getElementById('timeLeft').innerHTML = moment('{{$quiz->end_date}}').fromNow()
    //         // document.getElementById('timeLeft2').innerHTML = moment().locale('{{ config('app.locale') }}').format('LTS')
    //     }, 60000)
</script>
@endpush