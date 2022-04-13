<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                {{-- TODO: Only show active quizzes/sections --}}
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    Quizzes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <h6 class="dropdown-header">Active Quizzes</h6>
                    @foreach ($course->quizzes as $quiz)

                    <a class="dropdown-item"
                        href="{{ route('teacher.quiz.show', ['course' => $course, 'quiz' => $quiz]) }}">
                        {{$quiz->name}}
                    </a>
                    @endforeach

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('teacher.quiz.create', ['course' => $course]) }}">Create
                        Quiz</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    Sections
                </a>


                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <h6 class="dropdown-header">Active Sections</h6>
                    @foreach ($course->sections as $section)
                    <a class="dropdown-item"
                        href="{{ route('teacher.course.section.show', ['course' => $course, 'section' => $section]) }}">
                        {{$section->name}}
                    </a>
                    @endforeach

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                        href="{{ route('teacher.course.section.create', ['course' => $course]) }}">Add
                        New
                        Section</a>
                </div>

            </li>
        </ul>
    </div>
</nav>