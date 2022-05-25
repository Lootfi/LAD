<div>
    <div>
        <div class="row">
            <h6 class="ml-1">Knowledge Components Awareness: </h6>
        </div>
        <div class="row">
            @foreach ($kcs as $kc_id => $kc_name)
            @if ($kcs_awareness[$kc_id] == -1)
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-secondary mr-1 mt-1">{{$kc_name}}</a>
            @elseif ($kcs_awareness[$kc_id] == 0)
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-danger mr-1 mt-1">{{$kc_name}}</a>
            @else
            <a href="{{ route('teacher.course.kc.show', ['course' => $quiz->course, 'kc' => $kc_id]) }}"
                class="badge badge-success mr-1 mt-1">{{$kc_name}}</a>
            @endif
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    @if (in_array(-1, $kcs_awareness) || in_array(0, $kcs_awareness))
                    <button type="button" class="btn btn-danger" wire:click="notify">
                        <i class="fas fa-bell"></i>
                        Notify
                    </button>
                    @endif
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i>
                        Message
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>