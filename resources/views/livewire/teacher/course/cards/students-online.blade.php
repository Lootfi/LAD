<div class="card shadow">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Status</h6>
                <h2 class="mb-0">Students Online</h2>
            </div>
        </div>
    </div>
    <div wire:poll.60s class="card-body">
        @if ($students->isEmpty())
        <div class="text-center">
            <h4 class="text-muted">No students online</h4>
        </div>
        @else
        @foreach ($students as $student)
        @if ($student->isOnline())
        <div class="row align-items-center no-gutters">
            <div class="col-auto w-25">
                <img src="{{ $student->avatar }}" class="avatar avatar-sm rounded-circle w-50">
            </div>
            <div class="col ml--2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 text-bold">{{ $student->name }}</h6>
                    </div>
                </div>
                <p class="text-sm mb-0 font-italic">
                    {{ $student->email }}
                </p>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
</div>