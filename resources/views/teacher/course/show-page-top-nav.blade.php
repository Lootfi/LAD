<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse show" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto d-flex flex-row justify-content-around">
            <li class="nav-item">

                <a class="nav-link {{request()->routeIs('teacher.course.show') ? 'active' : ''}}"
                    href="{{ route('teacher.course.show', ['course'=> $course]) }}">Home</a>
            </li>
            <li class="nav-item dropdown">
                {{-- TODO: Only show active quizzes/sections --}}
                <a class="nav-link dropdown-toggle {{request()->routeIs('teacher.quiz*') ? 'active' : ''}}" href="#"
                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Quizzes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('teacher.quiz.index', ['course' => $course]) }}">All
                        Quizzes</a>
                    <div class="dropdown-divider"></div>

                    <h6 class="dropdown-header">Active Quizzes</h6>
                    @foreach ($course->quizzes as $quiz)
                    @if ($quiz->is_active)
                    <a class="dropdown-item {{request()->is('teacher/course/' . $course->id . '/quiz/' . $quiz->id ) ? 'active' : ''}}"
                        href="{{ route('teacher.quiz.show', ['course' => $course, 'quiz' => $quiz]) }}">
                        <span>{{$quiz->name}}</span>
                    </a>
                    @endif
                    @endforeach

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('teacher.quiz.create', ['course' => $course]) }}">Create
                        Quiz</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{request()->routeIs('teacher.course.section*') ? 'active' : ''}}"
                    href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Sections
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <h6 class="dropdown-header">Active Sections</h6>
                    @foreach ($course->sections as $section)
                    @if ($section->status == true)
                    <a class="dropdown-item {{request()->is('teacher/course/' . $course->id . '/section/' . $section->id ) ? 'active' : ''}}"
                        href="{{ route('teacher.course.section.show', ['course' => $course, 'section' => $section]) }}">
                        {{$section->name}}
                    </a>
                    @endif
                    @endforeach

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                        href="{{ route('teacher.course.section.create', ['course' => $course]) }}">Create Section</a>
                </div>

            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{request()->routeIs('teacher.student*') ? 'active' : ''}}" href="#"
                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Students
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{request()->is('teacher.student.manage') ? 'active' : ''}}"
                        href="{{ route('teacher.student.manage', ['course' => $course]) }}">
                        Manage Students
                    </a>
                    <a class="dropdown-item {{request()->is('teacher.student.import') ? 'active' : ''}}"
                        href="{{ route('teacher.student.import', ['course' => $course]) }}">Import
                        Students</a>
                </div>

            </li>

            <li class="nav-item">

                <a class="nav-link {{request()->routeIs('teacher.kc.manage') ? 'active' : ''}}"
                    href="{{ route('teacher.kc.manage', ['course' => $course]) }}">Manage KCs</a>
            </li>
        </ul>
    </div>
</nav>