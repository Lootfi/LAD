<div class="row">
    @if(count($quizzes) > 0)
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Active Quizzes</h3>
            </div>
            <div class="card-body">
                <table id="quizzes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>Time Left</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->name }}</td>
                            <td>{{ $quiz->start_date }}</td>
                            <td>{{ $quiz->end_date->diffForHumans(['parts' => 6]) }}</td>
                            <td>
                                <a href="{{ route('student.quiz.show', ['course' => $quiz->course, 'quiz' => $quiz]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">No Active Quizzes</h3>
            </div>
            <div class="card-body">
                <p>There are no active quizzes for this course.</p>
            </div>
        </div>
    </div>
    @endif
</div>