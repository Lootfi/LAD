<div>
    <div class="row my-3">
        {{-- search input --}}
        <div class="col-md-6">
            <input type="text" wire:model="search" class="form-control" id="search" placeholder="Filter by Name...">
        </div>
    </div>
    <div class="row mb-3">
        {{-- bootstrap column card groups --}}
        {{-- <div class="r"> --}}
            @forelse ($students as $student)
            <livewire:teacher.quiz.monitor.student :quiz="$quiz" :student="$student" :wire:key="$student->id" />
            @empty
            <div class="w-100 card mr-2 mt-1 px-0" style="width: 360px;">
                <div class="card-body">
                    <h4 class="card-title">No students found</h4>
                </div>
            </div>
            @endforelse
            {{--
        </div> --}}
    </div>

    <livewire:teacher.quiz.monitor.info-table :quiz="$quiz" />
</div>