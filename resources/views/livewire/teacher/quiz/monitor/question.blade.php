@if ($answered)
<div class="card text-center py-2">
    <p class="card-text">Q{{$index}}</p>
    <p class="card-text">
        @if ($correct)
        <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
        @else
        <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
        @endif
    </p>
</div>
@else
<div class="card text-center bg-dark py-2">
    <p class="card-text">Q{{$index+1}}</p>
    <i class="fa fa-check-circle fa-lg invisible" aria-hidden="true"></i>
</div>
@endif

@push('js')
<script>
    Echo.channel('questionanswered')
        .listen('QuestionAnswered', (e) => {
            console.log(e);
        });
</script>
@endpush