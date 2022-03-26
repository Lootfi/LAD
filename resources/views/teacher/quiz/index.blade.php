@extends('layouts.app')

@section('title', 'Course Quizzes')

@section('breadcrumbs')
<li class="breadcrumb-item">Quizzes</li>
@endsection

@section('content')
<div class="container-fluid mt--6">
    {{-- table of course quizzes --}}
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0">Dark table</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Quiz</th>
                                <th scope="col" class="sort" data-sort="start_date">Start Date</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col">Students</th>
                                <th scope="col" class="sort" data-sort="completion">Completion</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            {{-- table rowd of course quizzes --}}
                            @foreach ($course->quizzes as $quiz)
                            <tr>
                                {{-- quiz name --}}
                                <th scope="row">
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
                                    @if ($quiz->start_date > now())
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-warning"></i>
                                        <span class="status">Not Started</span>
                                    </span>


                                    @elseif ($quiz->start_date < now() && $quiz->end_date > now())
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-success"></i>
                                            <span class="status">In Progress</span>
                                        </span>
                                        @elseif ($quiz->end_date < now()) <span class="badge badge-dot mr-4">
                                            <i class="bg-danger"></i>
                                            <span class="status">Finished</span>
                                            </span>
                                            @endif

                                </td>

                                {{-- quiz students --}}
                                <td>
                                    <div class="avatar-group">
                                        @foreach ($course->students as $student)
                                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip"
                                            data-original-title="{{ $student->name }}">
                                            <img alt="U"
                                                src="{{ asset('storage/profile_pictures/' . $student->profile_picture) }}">
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
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $quiz->completion }}%"
                                                    aria-valuenow="{{ $quiz->completion }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
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
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            {{-- link to course's quiz edit page --}}
                                            <a class="dropdown-item"
                                                href="{{ route('teacher.quiz.edit', [$course, $quiz]) }}">
                                                Edit Quiz
                                            </a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection