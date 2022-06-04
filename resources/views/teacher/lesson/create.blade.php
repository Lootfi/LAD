@extends('adminlte::page')

@section('title', 'Create Lesson')

@section('content_header')
<li class="breadcrumb-item"><a
                href="{{ route('teacher.course.section.show', ['course' => $course, 'section' => $section]) }}">Section:
                {{$section->name}}</a>
<li class="breadcrumb-item active">Create Lesson</li>
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                        <!-- form start -->
                        <form role="form" method="POST"
                                action="{{ route('teacher.course.section.lesson.store', ['course' => $course, 'section' => $section]) }}">
                                @csrf
                                <div class="box-body">
                                        {{-- title --}}
                                        <div class="form-group">
                                                <label for="name">Title</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter Title" value="Lesson Name">
                                        </div>
                                        {{-- /title --}}
                                        {{-- description --}}
                                        <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                        rows="3" placeholder="Enter Description"></textarea>
                                        </div>
                                        {{-- /description --}}
                                        {{-- status --}}
                                        <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                </select>
                                        </div>
                                        {{-- /status --}}
                                        {{-- kcs --}}
                                        <div class="form-group">
                                                <label for="kcs">KCS</label>
                                                <select class="lesson_kcs_select form-control" id="kcs" name="kcs[]"
                                                        multiple="multiple" autocomplete="off">
                                                        @foreach ($course->kcs as $kc)
                                                        <option value="{{$kc->id}}">{{$kc->name}}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                        {{-- /kcs --}}
                                        {{-- content --}}
                                        <label for="lesson_content">Lesson</label>
                                        <input name="content" id="lesson_content" type="hidden" />
                                        <trix-editor input="lesson_content" class="trix-content"></trix-editor>
                                        {{-- /content --}}
                                </div>
                                <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                        </form>
                </div>
        </div>
</div>
@endsection


@push('js')
<script src="{{ asset('js/lessons/attachements.js') }}"></script>
<script>
        $(document).ready(function() {
    $('.lesson_kcs_select').select2({
        language: {
            noResults: function() {
                return $(`<button type="button" class="btn btn-primary" onclick="createNewKc()">Create new KC '${document.getElementsByClassName('select2-search__field')[0].value}' for this course</button>`);
            }
        }
    });

});
function createNewKc() {
        var newKc = {
                name: document.getElementsByClassName('select2-search__field')[0].value,
                description: 'No description',
                course_id: `{{$course->id}}`,
                _token: "{{ csrf_token() }}",
        };
        $.ajax({
                url: `{{ route('teacher.kc.faststore', ['course' => $course]) }}`,
                type: 'POST',
                data: newKc,
                success: function(data) {
                $('.lesson_kcs_select').append(new Option(data.name, data.id, true, true)).trigger('change');
                }
        });
}
</script>
@endpush