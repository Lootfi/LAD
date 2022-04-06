<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('teacher.quiz.create', ['course' => $course]) }}">Create
                        Quiz</a>

                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    Sections
                </a>


                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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