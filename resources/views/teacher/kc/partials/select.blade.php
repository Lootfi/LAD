{{-- kcs --}}
<div class="form-group">
    <label for="kcs">KCS</label>
    <select class="kcs_select form-control" id="kcs" name="kcs[]" multiple="multiple" autocomplete="off">
        @foreach ($course->kcs as $kc)
        <option value="{{$kc->id}}" @if($editForm==true) @selected($model->kcs->contains($kc)) @endif>{{$kc->name}}
        </option>
        @endforeach
    </select>
</div>
{{-- /kcs --}}

@push('js')
<script>
    $(document).ready(function() {
    $('.kcs_select').select2({
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
                $('.kcs_select').append(new Option(data.name, data.id, true, true)).trigger('change');
                }
        });
}
</script>
@endpush