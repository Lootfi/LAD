<div class="col mb-4" wire:click="chooseQuestion">
    @if ($answered)
    <div class="item card text-center py-2 {{$selected ? 'bg-info' : 'bg-white'}}">
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
    <div class="item card text-center {{$selected ? 'bg-info' : 'bg-dark'}} py-2">
        <p class="card-text">Q{{$index}}</p>
        <i class="fa fa-check-circle fa-lg invisible" aria-hidden="true"></i>
    </div>
    @endif
</div>

@push('css')
<style>
    .item {
        text-decoration: none;
        color: #222;
        text-transform: uppercase;
        text-align: center;
        position: relative;
        font-family: 'Oswald';
        cursor: pointer;
    }

    .item:before {
        content: '';
        position: absolute;
        width: calc(100% + 8px);
        height: calc(100% + 8px);
        top: calc(4px/-1);
        left: calc(4px/-1);
        background: linear-gradient(to right, #222 0%, #222 100%), linear-gradient(to top, #222 50%, transparent 50%), linear-gradient(to top, #222 50%, transparent 50%), linear-gradient(to right, #222 0%, #222 100%), linear-gradient(to left, #222 0%, #222 100%);
        background-size: 100% 4px, 4px 200%, 4px 200%, 0% 4px, 0% 4px;
        background-position: 50% 100%, 0% 0%, 100% 0%, 100% 0%, 0% 0%;
        background-repeat: no-repeat, no-repeat;
        transition: transform 0.2s ease-in-out, background-position 0.2s ease-in-out, background-size 0.2s ease-in-out;
        transform: scaleX(0) rotate(180deg);
        transition-delay: 0.1s, 0.1s, 0s;
    }

    .item:hover:before {
        background-size: 200% 4px, 4px 400%, 4px 400%, 55% 4px, 55% 4px;
        background-position: 50% 100%, 0% 100%, 100% 100%, 100% 0%, 0% 0%;
        transform: scaleX(1) rotate(180deg);
        transition-delay: 0s, 0.2s, 0.4s;
    }
</style>
@endpush