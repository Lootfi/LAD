@php
$section = App\Models\Lesson::where('id',$row->id)->first()->section;
@endphp

<div class="row">
    <div class="col-auto">
        <a href="{{ route('teacher.course.section.lesson.edit', ['course' => $section->course, 'section' => $section, 'lesson' => $row]) }}"
            class="btn btn-sm btn-icon btn-2 btn-primary btn-text-secondary">
            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
        </a>
    </div>
</div>