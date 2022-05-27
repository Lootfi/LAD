<div>
    <div class="btn-group" role="group" aria-label="Basic example">
        @foreach ($kcs as $kc)
        <button wire:click="clickKc({{$kc['id']}})" type="button"
            class="btn {{in_array($kc['id'], $this->selected_kcs) ? 'btn-primary' : 'btn-secondary'}}">{{$kc['name']}}</button>
        @endforeach
    </div>
    <button wire:click="selectAll" type="button" class="btn btn-info">select/deselect All</button>
</div>