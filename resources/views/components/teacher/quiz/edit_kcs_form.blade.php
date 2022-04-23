@php
$kc_id_array_dirty = $question->kcqs()->get(['kc_id'])->toArray();
$kc_ids = [];

foreach ($kc_id_array_dirty as $kcq) {
$kc_ids[] = $kcq['kc_id'];
}
$kc_rest = App\Models\Kc::whereNotIn('id', $kc_ids)->get();
@endphp

<div class="form-group" name="question_kcs" id="question-kcs-{{$question->id}}">
    <select class="select-multi-kcs-{{$question->id}} w-100" name="q_kcs[]" multiple="multiple" autocomplete="off">

        @foreach ($question->kcqs as $kcq)
        <option value="{{$kcq->kc->id}}" selected>{{$kcq->kc->name}}</option>
        @endforeach
        @foreach ($kc_rest as $kc)
        <option value="{{$kc->id}}">{{$kc->name}}</option>
        @endforeach
    </select>
</div>

@push('js')
<script>
    $(document).ready(function() {
    $('.select-multi-kcs-{{$question->id}}').select2({
        language: {
            noResults: function() {
                return $("<a href='{{route('teacher.kc.manage', ['course' => $question->quiz->course])}}'>Create new KC " + "'" + 
                document.getElementById('question-kcs-{{$question->id}}').getElementsByClassName('select2-search__field')[0].value
                + "'" + " for this course</a>");
            }
        }
    });
});
</script>
@endpush