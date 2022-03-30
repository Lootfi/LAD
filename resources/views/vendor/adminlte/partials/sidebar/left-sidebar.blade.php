<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300)
                data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                {{-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}


                {{-- sidenar link to teacher's course --}}
                @role('teacher')
                {{-- header --}}
                <li class="nav-header">
                    COURSES
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.course.show',['course' => auth()->user()->teaches]) }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <p>
                            Course
                        </p>
                    </a>
                </li>
                {{-- teacher's course quizzes index page --}}
                <li class="nav-item">
                    <a href="{{ route('teacher.quiz.index', auth()->user()->teaches) }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <p>
                            Quizzes
                        </p>
                    </a>
                </li>
                {{-- create quiz --}}
                <li class="nav-item">
                    <a href="{{ route('teacher.quiz.create', auth()->user()->teaches) }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <p>
                            Create Quiz
                        </p>
                    </a>
                </li>
                @endrole


                {{-- sidenar link to student's course --}}
                @role('student')

                <li class="nav-item has-treeview">
                    {{-- white colored hr line --}}
                    <hr class="sidebar-divider ">
                    {{-- Menu toggler --}}
                    <a class="nav-link" href="">

                        <i class="fas fa-fw fa-share' }}"></i>
                        <p>
                            My Courses
                            <i class="fas fa-angle-left right"></i>
                        </p>

                    </a>
                    {{-- Menu items --}}
                    <ul class="nav nav-treeview">
                        {{-- foreach student courses --}}
                        @foreach(auth()->user()->courses as $course)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('student.course.show',['course' => $course])}}">
                                <i class=""></i>
                                <p>
                                    {{ $course->title }}
                                </p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <hr class="sidebar-divider ">

                </li>



                @endrole

            </ul>
        </nav>
    </div>

</aside>