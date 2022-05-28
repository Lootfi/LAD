<div class="w-100">
    <div>
        <div class="alert alert-warning" role="alert">
            You can get better split results by increasing the split percentage.
        </div>
        <div class="alert alert-warning" role="alert">
            You can get better split results by having more quizzes with multiple questions.
        </div>
    </div>
    <label for="split_percentage">Split Percentage</label>
    <div class="input-group mb-3">
        <input type="number" class="form-control" placeholder="Split Percentage" wire:model="split_percentage">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" wire:click="fetchSplittable">Fetch Possible
                Splits</button>
        </div>
        @error('split_percentage') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row w-100">
        @if (isset($question_groups_er_diffs))
        @if (count($question_groups_er_diffs) == 0)
        Nothing to show
        @elseif (count($question_groups_er_diffs) >= 1)
        <div class="accordion w-100" id="splits">
            @foreach ($question_groups_er_diffs as $key => $group)
            <div class="card w-100">
                <div class="card-header" id="heading-{{$key}}">
                    <h5 class="mb-0">
                        <button
                            class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center text-info"
                            type="button" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="true"
                            aria-controls="collapse-{{$key}}">
                            #Group {{$key+1}}: [ @foreach($group['questions'] as $question) #Q{{$question->id}}
                            @endforeach ] share {{$group['kcs']->count()}} Knowledge Component{{$group['kcs']->count()
                            >= 2 ? 's':''}}
                        </button>
                    </h5>
                </div>
                <div id="collapse-{{$key}}" class="collapse {{$key == 0 ? 'show': ''}} w-100"
                    aria-labelledby="heading-{{$key}}" data-parent="#splits">
                    <div class="card-body">
                        @foreach ($group['diffs'] as $diff)

                        <span class="text-info">#Q{{$diff['q1']}}:</span>
                        <span>{{$group['questions']->where('id',$diff['q1'])->first()->question}}</span>
                        <br>
                        <span class="text-info">#Q{{$diff['q2']}}:</span>
                        <span>{{$group['questions']->where('id',$diff['q2'])->first()->question}}</span>
                        <br>
                        <b class="text-info">The Error Rate difference: <span
                                class="text-danger">{{$diff['diff']}}</span></b>
                        <hr>
                        @endforeach
                        <span class="text-info">Splittable Knowledge Components: </span>
                        @foreach ($group['kcs'] as $kc)
                        <a href="{{ route('teacher.kc.split', ['course' => $course, 'kc' => $kc]) }}"
                            class="badge badge-danger mr-1 mt-1">split: <span
                                class="font-weight-bold font-italic">{{$kc->name}}</span></a>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @endif
    </div>

</div>