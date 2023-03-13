@if ($category->exists)
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="text-white"
        enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.categories.store') }}" method="POST" class="text-white"
            enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    {{-- Titolo --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label for="label" class="form-label">Label</label>
            <input type="text" name="label" id="label"
                class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $category->label) }}"
                minlength="3" maxlength="15">
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci il nome</div>
            @enderror

        </div>
    </div>
    {{-- Color --}}
    <div class="col-md-1">
        <div class="mb-3">
            <label for="color" class="form-label">Colore</label>
            <input type="color" id="color" name="color" class="form-control"
                value="{{ old('color', $category->color) }}">
        </div>
    </div>


</div>



{{-- Bottone --}}
<footer class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-floppy-disk"></i>
    </button>
</footer>
</form>
