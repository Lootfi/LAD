<div class="smartwizard">
    <ul class="steps d-flex">
        <li
            class="step-link step-1-link @if ($current_step == 1) text-info @elseif($current_step > 1) text-success @endif">
            Step
            1<br /><small>Number of Splits
                :
                @json($splitnum )</small></li>
        <li
            class="step-link step-2-link @if ($current_step == 2) text-info @elseif($current_step > 2) text-success @endif">
            Step 2<br /><small>Split KC</small>
        </li>
        <li
            class="step-link step-3-link @if ($current_step == 3) text-info @elseif($current_step > 3) text-success @endif">
            Step 3<br /><small>Assign New KCs to
                Lessons</small></li>
        <li
            class="step-link step-4-link @if ($current_step == 4) text-info @elseif($current_step > 4) text-success @endif">
            Step 4<br /><small>Assign New KCs to
                Questions</small></li>
        <li class="step-link step-5-link @if ($current_step == 5) text-success @endif">
            Step 5<br /><small>Done</small></li>
    </ul>
    <div class="steps-content">
        @switch($current_step)
        @case(1)
        <div class="step step-1">
            <div class="row">
                <h4 class="text-center w-100">The splittable Knowledge Component : <b>{{' ' . $kc->name . ' '}}</b> has
                    <span class="text-info">
                        {{$lessons->count()}}
                        lesson(s)
                    </span> and <span class="text-info">{{$questions->count()}} question(s)</span>
                </h4>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="splitnum">Number of Splits: </label>
                    <input wire:model.defer="splitnum" id="splitnum" type="number" class="form-control"
                        placeholder="2 or 3" required>
                    @error('splitnum') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        @break
        @case(2)
        <div class="step step-2">
            <div class="row">
                <h4 class="text-center w-100">In this step, You are going to split <span
                        class="text-info">@json($kc->name)</span> into
                    <span class="text-info">@json($splitnum) KCs</span>.
                </h4>
            </div>
            @for ($i = 1; $i <= $splitnum; $i++) <div class="row @if($i != 1) mt-3 @endif">
                <div class="col-md-6">
                    <label for="split-{{$i}}">New Knowledge Component (Split {{$i}}): </label>
                    <input wire:model.defer="splits.{{$i}}" id="split-{{$i}}" type="text" class="form-control"
                        placeholder="Split {{$i}}" required>
                </div>
                <div>@error('splits.' . $i)
                    <span class="error text-danger small">{{ $message }}</span> @enderror
                </div>

                <div>@error('splits')
                    <span class="error text-danger small">{{ $message }}</span> @enderror
                </div>
        </div>

        @endfor
    </div>
    @break
    @case(3)
    <div class="step step-3">
        <div class="row">
            <h4 class="text-center w-100">In this step, You are going to assign the <span
                    class="text-info">@json($splitnum) newly created KCs</span> to the <span class="text-danger">old
                    KC's ({{$kc->name}})</span> lessons.
            </h4>
            <br>
            <h4 class="text-center w-100">Choose at least one new KC for every lesson from the split :</h4>

        </div>
        @foreach ($lessons as $lesson)
        <div class="row lesson-row mt-3 px-2 py-3 mx-2">
            <h4>Lesson : {{$lesson->name}}</h4>
            <div class="w-100 my-2"></div>
            {{-- kcs --}}
            <span class="text-info"> New KCs : </span>
            @foreach ($splits as $key => $split)
            <div class="form-check form-check-inline mx-2">
                <input wire:model.defer="lessons_kcs.{{$lesson->id}}" class="form-check-input" type="checkbox"
                    id="lesson-{{$lesson->id}}-split-{{$key}}" value="{{$split}}">
                <label class="form-check-label" for="lesson-{{$lesson->id}}-split-{{$key}}"
                    value="{{$split}}">{{$split}}</label>
            </div>
            @endforeach
            {{-- /kcs --}}
            <div>@error('lessons_kcs.' . $lesson->id)
                <span class="error text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
        @endforeach
        <div class="mb-3"></div>
    </div>
    @break
    @case(4)



    <div class="row">
        <h4 class="text-center w-100">In this step, You are going to assign the <span class="text-info">@json($splitnum)
                newly created KCs</span> to the <span class="text-danger">old
                KC's ({{$kc->name}})</span> questions.
        </h4>
        <br>
        <h4 class="text-center w-100">Choose at least one new KC for every quetion from the split :</h4>

    </div>
    @foreach ($questions as $question)
    <div class="row question-row mt-3 px-2 py-3 mx-2">
        <h4>Question : {{$question->question}}</h4>
        <div class="w-100 my-2"></div>
        {{-- kcs --}}
        <span class="text-info"> New KCs : </span>
        @foreach ($splits as $key => $split)
        <div class="form-check form-check-inline mx-2">
            <input wire:model.defer="questions_kcs.{{$question->id}}" class="form-check-input" type="checkbox"
                id="question-{{$question->id}}-split-{{$key}}" value="{{$split}}">
            <label class="form-check-label" for="question-{{$question->id}}-split-{{$key}}">{{$split}}</label>
        </div>
        @endforeach
        {{-- /kcs --}}
        <div>@error('questions_kcs.' . $question->id)
            <span class="error text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>
    @endforeach
    <div class="mb-3"></div>




    @break
    @case(5)
    <div class="step step-5">
        <div class="row">
            <h4 class="text-center w-100 text-success">Good job! The Knowledge component has been splitted successfully.
            </h4>
            <h5 class="ml-2 w-100 mt-5">You can verify that by going to the newly created KCs pages :</h5>
            @isset($new_kcs)
            @foreach ($new_kcs as $kc)
            <a href="{{ route('teacher.course.kc.show', ['course' => $course, 'kc' => $kc->id]) }}"
                class="badge badge-success mr-1 mt-1">{{$kc->name}}</a>
            @endforeach
            @endisset

        </div>
    </div>
    @break
    @endswitch
    @if ($current_step != 5)
    <div class="row w-100 justify-content-end">
        <button wire:click="goNext" type="button" class="btn btn-primary btn-lg">Next</button>
    </div>
    @else
    <div class="row w-100 justify-content-end">
        <a href="{{ route('teacher.course.show', ['course' => $course]) }}" type="button"
            class="btn btn-primary btn-lg">Finish</a>
    </div>
    @endif
</div>
</div>

@section('css')
<style>
    .smartwizard {
        margin-top: 1em;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    }

    .steps {
        list-style: none;
        justify-content: space-around;
        padding: 1em;
        box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
    }

    .steps-content {
        padding: 1em;
    }

    .lesson-row {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;
    }

    .question-row {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;
    }
</style>
@endsection