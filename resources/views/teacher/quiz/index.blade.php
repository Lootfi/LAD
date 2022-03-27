@extends('adminlte::page')

@section('title', 'Course Quiz - Edit')

@section('content_header')
<li class="breadcrumb-item">Course</li>
@endsection

@section('css')

<link rel="stylesheet" href="{{asset('css/avatars.css')}}">
@endsection

@section('content')



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
                    <img alt="Image placeholder" src="{{ $student->avatar }}" class="avatar-img rounded-circle ">
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
                    {{-- link to course's quiz edit page --}}
                    <a class="dropdown-item" href="{{ route('teacher.quiz.edit', [$course, $quiz]) }}">
                        Edit Quiz
                    </a>
                    {{-- delete button that shows a confirmation modal --}}
                    <button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
                        data-url="{{ route('teacher.quiz.destroy', [$course, $quiz]) }}">
                        Delete Quiz
                    </button>
                    {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                </div>
            </div>
        </td>
        <td></td>
    </tr>
    @endforeach
</x-adminlte-datatable>

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
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


{{-- js section --}}

@section('js')


@endsection