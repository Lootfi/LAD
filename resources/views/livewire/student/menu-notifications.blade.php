{{-- top nav bar notification icon --}}
<li class="nav-item dropdown">
    {{-- onclick, mark notifications as read --}}
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" id='notifications-bell'>
        <i class="far fa-bell"></i>
        @if(count($notifications) > 0)
        <span class="badge badge-danger navbar-badge">{{ count($notifications) }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @if(count($notifications) > 0)
        <span class="dropdown-item dropdown-header">{{ count($notifications) }} Notifications</span>
        {{-- list student notifications of new quizzes --}}
        @foreach($notifications as $notification)
        <div class="dropdown-divider"></div>
        @if ($notification->type == 'App\Notifications\NewQuiz')
        <a href="{{ route('student.quiz.show', ['course' => $notification->data['quiz']['course_id'], $notification->data['quiz']['id']]) }}"
            class="dropdown-item">
            <div class="row">
                <div class="col-md-9">
                    <div class="text-dark">
                        <strong>{{ $notification->data['message'] }}</strong>
                        <span class="small float-right text-muted">{{ $notification->created_at->diffForHumans()
                            }}</span>
                        <div class="small text-muted">{{ $notification->data['quiz']['name'] }}</div>
                    </div>
                </div>
            </div>
        </a>
        @elseif ($notification->type == 'App\Notifications\NewLesson')
        <a href="{{ route('student.course.section.lesson.show', ['course' => $notification->data['lesson']['section']['course']['id'],
        'section' => $notification->data['lesson']['section_id'],
        'lesson' => $notification->data['lesson']['id']
        ]) }}" class="dropdown-item">
            <div class="row">
                <div class="col-md-9">
                    <div class="text-dark">
                        <strong>{{ $notification->data['message'] }}</strong>
                        <span class="small float-right text-muted">{{ $notification->created_at->diffForHumans()
                            }}</span>
                        <div class="small text-muted">{{ $notification->data['lesson']['name'] }}</div>
                    </div>
                </div>
            </div>
        </a>
        @elseif ($notification->type == 'App\Notifications\QuizKcAwarenessWarning')
        <div class="dropdown-item">
            <div class="row">
                <div class="text-dark">
                    <p>{{ $notification->data['message'] }}</p>
                    <span class="small text-muted">{{ $notification->created_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>
        @endif

        @endforeach
        @else
        <span class="dropdown-item dropdown-header">No Notifications</span>

        @endif
        <div class="dropdown-divider"></div>
        {{-- <a href="{{ route('admin.notifications.index') }}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ __('adminlte::adminlte.view_all') }}
        </a> --}}
    </div>
</li>
{{-- end top nav bar notification icon --}}

{{-- push a new script to js section --}}
@push('js')
<script>
    // when #notifications-bell is clicked, mark all student notifications as read, pass student as param to route
    $('#notifications-bell').click(function () {
        if ($('.navbar-badge').length > 0) {
        $.ajax({
            url: "{{ route('student.notifications.markAsRead') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (data) {
                $('#notifications-bell').find('.badge').remove();
                $('#notifications-bell').find('.dropdown-menu').empty();
            }
        });
    }
    });

</script>

<script>
    window.Echo.private('users.{{ Auth::user()->id }}').notification((notification) => {
        console.log(notification);
    });
</script>
@endpush