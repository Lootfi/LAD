<div>
    <form wire:submit.prevent="save">
        <div>
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <div>
                <h2>Duplicates:</h2>
                @foreach ($duplicates as $dupl)
                <p>{{$dupl}}</p>
                @endforeach
            </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="students_file" class="form-label">Students</label>
            <input type="file" wire:model="students_file" class="my-pond form-control">
        </div>
        <div wire:loading wire:target="students_file">Uploading...</div>
        @error('students_file') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Import</button>

    </form>

    <div class="alert alert-light" role="alert">
        First row: id<br>
        Second row: name <br>
        Third row: email
    </div>
    <div class="alert alert-light" role="alert">
        Default password: password <br>
        The file must contain no headers <br>
        Duplicates will be ignored.
    </div>
</div>