<div class="card mx-1" style="width: 90px;" data-toggle="tooltip" data-placement="top" data-title="<h6>KCs:</h6>
    @foreach ($question->kcs as $kc)
    {{$kc->name}}
    {{-- if loop last --}}
    @if (!$loop->last)
    ,
    @endif
    @endforeach">
    @if ($answered)
    <div class="card-body text-center py-2 bg-white">
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
    <div class="card-body text-center bg-dark py-2">
        <p class="card-text">Q{{$index}}</p>
        <i class="fa fa-check-circle fa-lg invisible" aria-hidden="true"></i>
    </div>
    @endif
</div>


@once
@push('js')
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip({
      html: true
  })
})
</script>
@endpush
@endonce