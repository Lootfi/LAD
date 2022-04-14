@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
@php( $def_container_class = 'container' )
@else
@php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">

    {{-- Content Header --}}
    @hasSection('content_header')
    <div class="content-header">
        <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            @role('teacher')
                            <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i
                                        class="fas fa-home"></i></a></li>
                            @endrole

                            @role('student')
                            <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}"><i
                                        class="fas fa-home"></i></a></li>

                            @endrole
                            @yield('content_header')

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <div class="content">

        {{-- view success message when students are notified --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @if (auth()->user()->hasRole('teacher'))
            {{-- show page top navigation --}}
            @include('teacher.course.show-page-top-nav', ['course' => $course])
            @endif
            {{-- yield content --}}
            @yield('content')
        </div>

    </div>

</div>