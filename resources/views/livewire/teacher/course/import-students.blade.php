<div>
    <div class="alert alert-light mt-5" role="alert">
        Accepted columns : <span class="text-bold">name, email, password</span>
    </div>
    <form wire:submit.prevent="save">
        <div>
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div>
            <div class="mb-3 w-75">
                <label for="students_file" class="form-label">Students</label>
                <div class="d-flex" style="align-items: center;">
                    <input type="file" wire:model="students_file" class="my-pond form-control mr-2">
                    <button class="btn btn-info h-auto" type="submit">Import</button>
                </div>
            </div>
            @error('students_file') <span class="error">{{ $message }}</span> @enderror
        </div>
    </form>
    <br>
    <div class="alert alert-warning" role="alert">
        * If a password is not provided, the default password is: password <br>
        * Each column must contain a header, namely: <span class="text-bold">name, email, password</span>
        <br>
        * Do not worry about duplicates.
    </div>
</div>