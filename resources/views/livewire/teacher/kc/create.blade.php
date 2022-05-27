<div class="w-100">
    <form wire:submit.prevent="createKC">
        <div class="form-group">
            <label for="name">KC Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter KC Name" wire:model="name">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">KC Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter KC Description"
                wire:model="description"></textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{-- create button --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>