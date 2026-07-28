<div class="row">
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" id="title"
                class="form-control round @error('title') is-invalid @enderror"
                value="{{ old('title', $role->title ?? '') }}" placeholder="Title Input...">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="3" placeholder="Description Input...">{{ old('description', $role->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
