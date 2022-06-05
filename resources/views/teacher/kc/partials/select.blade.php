{{-- kcs --}}
<div class="form-group" @if($editForm==true) id="kcs-{{$model->id}}" @else id="kcs" @endif>
    <label for="kcs">KCS</label>
    <select class="kcs_select form-control" name="kcs[]" multiple="multiple" autocomplete="off">
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
        $(@if ($editForm==true) "#kcs-{{$model->id}}" @else "#kcs" @endif +' .kcs_select').select2({
            language: {
                noResults: function() {
                    return $(`<button type="button" class="btn btn-primary" onclick="window.createNewKc` + @if ($editForm==true) "{{$model->id}}" @else '' @endif + `()">Create new KC '${document.getElementById(@if ($editForm==true) "kcs-{{$model->id}}" @else "kcs" @endif).getElementsByClassName('select2-search__field')[0].value}' for this course</button>`);
                }
            }
        });
});


window['createNewKc' + @if ($editForm==true) "{{$model->id}}" @else '' @endif] = function() {
    let editForm = @json($editForm);



        var newKc = {
                name: document.getElementById(@if ($editForm==true) "kcs-{{$model->id}}" @else "kcs" @endif).getElementsByClassName('select2-search__field')[0].value,
                description: 'No description',
                course_id: `{{$course->id}}`,
                _token: "{{ csrf_token() }}",
        };

        $.ajax({
                url: `{{ route('teacher.kc.faststore', ['course' => $course]) }}`,
                type: 'POST',
                data: newKc,
                success: function(data) {
                $(@if ($editForm==true) "#kcs-{{$model->id}}" @else "#kcs" @endif +' .kcs_select').append(new Option(data.name, data.id, true, true)).trigger('change');

                document.getElementById(@if ($editForm==true) "kcs-{{$model->id}}" @else "kcs" @endif).getElementsByClassName('select2-search__field')[0].value = '';
                }
        });
}
</script>
@endpush