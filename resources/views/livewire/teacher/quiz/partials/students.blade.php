<div class="avatars">
    @foreach ($row->course->students as $student)
    <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top" title="{{$student->name}}">
        <img alt="Image placeholder" src="{{ $student->avatar }}" class="avatar-img rounded-circle">
    </a>
    @if ($loop->iteration == 4)
    @break
    @endif
    @endforeach


    @if (count($row->course->students) > 4)
    <a class="avatars-item" data-toggle="modal" data-target="#students-related-to-quiz-{{$row->id}}">
        <img class="avatar" alt="+{{count($row->course->students) - 4}}" src="">
    </a>

    <div class="modal fade" id="students-related-to-quiz-{{$row->id}}" tabindex="-1" role="dialog"
        aria-labelledby="students-related-to-quiz-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-answer-modal-label">{{ __('Students') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($row->course->students as $student)
                    {{-- list of students with avatars --}}
                    <div class="d-flex flex-direction-row pb-3">
                        <a href="#" class="avatars-item" data-toggle="tooltip" data-placement="top"
                            title="{{$student->name}}">
                            <img class="avatar" alt="Image placeholder" src="{{ $student->avatar }}">
                        </a>
                        <span>{{$student->name}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif


</div>

@once('js')
@push('js')
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush
@endonce