<div class="row">
    <div class="col-auto">
        <a href="{{ route('teacher.course.kc.show', ['course' => $row->course, 'kc' => $row]) }}"
            class="btn btn-sm btn-icon btn-2 btn-info btn-text-secondary">
            <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
        </a>
    </div>
    {{-- <div class="col-auto">
        <a href="{{ route('teacher.quiz.edit', ['course' => $row->course, 'quiz' => $row]) }}"
            class="btn btn-sm btn-icon btn-2 btn-primary btn-text-secondary">
            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
        </a>
    </div> --}}
    <div class="col-auto">
        <button class="btn btn-sm btn-icon btn-2 btn-danger btn-text-secondary" data-toggle="modal"
            data-target="#deleteModal-{{$row->id}}"
            data-url="{{ route('teacher.course.kc.destroy', ['course' => $row->course, 'kc' => $row]) }}">
            <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
        </button>
    </div>
</div>


{{-- delete kc confirmation modal --}}
<div class="modal fade" id="deleteModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete KC</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this KC? all the relationships with questions and lessons will also be
                deleted
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('teacher.course.kc.destroy', ['course' => $row->course, 'kc' => $row]) }}"
                    method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>