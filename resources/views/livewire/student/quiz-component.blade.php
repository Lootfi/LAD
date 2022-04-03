<div>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">

            <div class="col-xl-7 col-lg-8 col-md-9 d-flex">
                @foreach ($quiz->questions as $key => $question)
                <div class="card b-0 {{ $active_question->id != $question->id ? 'd-none' : '' }}">
                    @livewire('student.quiz.question-step', ['question' => $question, 'step' => $key],
                    key($question->id))
                </div>
                @endforeach
                <ul class="list-group mr-2">
                    @foreach ($quiz->questions as $key => $question)
                    {{-- rounded div --}}
                    <li class="list-group-item {{ $key == 0 ? 'active' : '' }}">
                        <span class="">{{ $key + 1 }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>