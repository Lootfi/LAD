<div class="dropdown">
    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="{{ route('teacher.quiz.edit', ['course' => $row->course,'quiz' => $row]) }}">
            Edit Quiz
        </a>
        <a class="dropdown-item" href="{{ route('teacher.quiz.sort', ['course' => $row->course, 'quiz' => $row]) }}">
            Sort Quiz Questions
        </a>
        <a class="dropdown-item" href="{{ route('teacher.quiz.notify', ['course' => $row->course, 'quiz' => $row]) }}">
            Notify Students
        </a>
        <button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
            data-url="{{ route('teacher.quiz.destroy', ['course' => $row->course, 'quiz' => $row]) }}">
            Delete Quiz
        </button>

    </div>
</div>

{{-- delete quiz confirmation modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Quiz</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this quiz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('teacher.quiz.destroy', ['course' => $row->course,'quiz' => $row]) }}"
                    method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>