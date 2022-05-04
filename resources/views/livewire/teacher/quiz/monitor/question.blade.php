<div class="col mb-4">
    @if ($answered)
    <div class="card text-center py-2 bg-white">
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
    <div class="item card text-center bg-dark py-2">
        <p class="card-text">Q{{$index}}</p>
        <i class="fa fa-check-circle fa-lg invisible" aria-hidden="true"></i>
    </div>
    @endif
</div>