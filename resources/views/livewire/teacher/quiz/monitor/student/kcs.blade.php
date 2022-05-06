<div>
    @foreach ($kcs as $kc_id => $kc_name)
    @if ($kcs_awareness[$kc_id] == -1)
    <span class="badge badge-secondary">{{$kc_name}}</span>

    @elseif ($kcs_awareness[$kc_id] == 0)
    <span class="badge badge-danger">{{$kc_name}}</span>
    @endif
    <span class="badge badge-success">{{$kc_name}}</span>
    @endforeach
</div>