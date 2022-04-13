@extends('adminlte::page')

@section('title', 'Course Quizzes')

@section('content_header')
<a href="{{ route('student.course.show', ['course' => $course]) }}" class="breadcrumb-item">Course</a>
<p class="breadcrumb-item">Quizzes</p>
@endsection

@section('content')


<livewire:teacher.quiz.table :course="$course" />


{{-- <x-adminlte-datatable id="table1" :heads="$heads" bordered hoverable :config="$config">
    @foreach ($course->quizzes as $quiz)
    <tr>
        <th scope=" row">
            <div class="media align-items-center">
                <div class="media-body">
                    <span class="name mb-0 text-sm">{{ $quiz->name }}</span>
                </div>
            </div>
        </th>
        <td class="start_date">
            <span class="badge badge-dot mr-4">
                <i class="bg-warning"></i>
                <span class="status">{{ $quiz->start_date }}</span>
            </span>
        </td>
        <td>
            <span>{{$quiz->status}}</span>

        </td>

        <td>
            <div class="avatar-group avatar-group-overlapped avatar-group-sm mr-40 mt-25">
                @foreach ($course->students as $student)
                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="{{ $student->name }}">
                    <img alt="Image placeholder" src="{{ $student->avatar }}" class="avatar-img rounded-circle">
                </a>
                @endforeach
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                @if ($quiz->completion)
                <span class="completion">{{ $quiz->completion }}%</span>
                <div class="ml-auto">
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $quiz->completion }}%"
                            aria-valuenow="{{ $quiz->completion }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                @else
                <span class="completion">Not yet</span>
                @endif
            </div>
        </td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('teacher.quiz.edit', [$course, $quiz]) }}">
                        Edit Quiz
                    </a>
                    <a class="dropdown-item" href="{{ route('teacher.quiz.sort', [$course, $quiz]) }}">
                        Sort Quiz Questions
                    </a>
                    <a class="dropdown-item" href="{{ route('teacher.quiz.notify', [$course, $quiz]) }}">
                        Notify Students
                    </a>
                    <button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
                        data-url="{{ route('teacher.quiz.destroy', [$course, $quiz]) }}">
                        Delete Quiz
                    </button>

                </div>
            </div>
        </td>
        <td></td>
    </tr>
    @endforeach
</x-adminlte-datatable> --}}

@endsection