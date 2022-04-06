@extends('adminlte::page')

@section('title', 'Course Quiz - Edit')

@section('content_header')
<li class="breadcrumb-item">Course</li>
@endsection

@section('content')

<livewire:teacher.quiz.table :course="$course" />

<x-adminlte-datatable id="table1" :heads="$heads" bordered hoverable :config="$config">
    @foreach ($course->quizzes as $quiz)
    <tr>
        {{-- quiz name --}}
        <th scope=" row">
            <div class="media align-items-center">
                <div class="media-body">
                    <span class="name mb-0 text-sm">{{ $quiz->name }}</span>
                </div>
            </div>
        </th>
        {{-- quiz start date --}}
        <td class="start_date">
            <span class="badge badge-dot mr-4">
                <i class="bg-warning"></i>
                <span class="status">{{ $quiz->start_date }}</span>
            </span>
        </td>
        {{-- course quiz status, depends on start_date --}}
        <td>
            {{-- get quiz custom attribute, status --}}
            <span>{{$quiz->status}}</span>

        </td>

        {{-- quiz active students --}}
        <td>
            {{-- quiz students avatar group --}}
            <div class="avatar-group avatar-group-overlapped avatar-group-sm mr-40 mt-25">
                @foreach ($course->students as $student)
                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="{{ $student->name }}">
                    <img alt="Image placeholder" src="{{ $student->avatar }}" class="avatar-img rounded-circle">
                </a>
                @endforeach
            </div>
        </td>
        {{-- quiz completion --}}
        <td>
            <div class="d-flex align-items-center">
                {{-- if quiz completion is set, show progress bar, else show not yet --}}
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
        {{-- quiz actions --}}
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
</x-adminlte-datatable>


{{-- js section --}}

@section('js')


@endsection