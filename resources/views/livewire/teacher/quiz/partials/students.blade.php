<div class="avatar-group avatar-group-overlapped avatar-group-sm mr-40 mt-25">
    @foreach ($row->course->students as $student)
    <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="{{ $student->name }}">
        <img alt="Image placeholder" src="{{ $student->avatar }}" class="avatar-img rounded-circle">
    </a>
    @endforeach
</div>