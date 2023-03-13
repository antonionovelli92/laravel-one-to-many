@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="text-white"
        enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" class="text-white" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    {{-- Titolo --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" name="title" id="title"
                class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}"
                minlength="3" maxlength="80">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci il titolo</div>
            @enderror

        </div>
    </div>
    {{-- Slug --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" class="form-control"
                value="{{ Str::slug(old('title', $project->title), '-') }}" disabled>
        </div>
    </div>
    {{-- Autore --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label for="author" class="form-label">Autore</label>
            <input type="text" name="author" id="author"
                class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $project->author) }}"
                required minlength="3" maxlength="80">
            @error('author')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci l'autore, cioè io, è il mio portfolio d'altronde.</div>
            @enderror
        </div>
    </div>
    {{-- Descrizione --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" name="description" id="description"
                class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $project->description) }}">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci la descrizione</div>
            @enderror


        </div>
    </div>
    {{-- Immagine --}}
    <div class="col-md-7">
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="file" name="image" id="image"
                class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $project->image) }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci l'immagine</div>
            @enderror
        </div>
    </div>
    {{-- Anteprima immagine --}}
    <div class="col-md-1">
        <img class="img-fluid" id="img-preview"
            src="{{ $project->image ? asset('storage/' . $project->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
            alt="">
    </div>
    {{-- Contenuto --}}
    <div class="col-md-12">
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content', $project->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci il contenuto</div>
            @enderror
        </div>
    </div>
    {{-- Link --}}
    <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="url_project" class="form-label">URL Progetto</label>
                <input type="url" name="url_project" id="url_project"
                    class="form-control @error('url_project') is-invalid @enderror"
                    value="{{ old('url_project', $project->url_project) }}">
                @error('url_project')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <div class="text-muted">Link diretto al progetto</div>
                @enderror
            </div>

        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="url_generic" class="form-label">URL Generico</label>
                <input type="url" name="url_generic" id="url_generic"
                    class="form-control @error('url_generic') is-invalid @enderror"
                    value="{{ old('url_generic', $project->url_generic) }}">
                @error('url_generic')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <div class="text-muted">Link personale</div>
                @enderror
            </div>
        </div>

        {{-- Tendina categorie --}}
        <div class="col-md-2">
            <div class="mb-5">
                <label for="category_id" class="form-label">Categorie</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                    id="category_id">
                    <option value="" selected>Nessuna categoria</option>
                    @foreach ($categories as $category)
                        <option @if (old('category_id', $project->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->label }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>
    </div>
    {{-- STATO --}}
    <div class="row ">
        <div class="col-md-12 my-5 d-flex justify-content-end ">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="is_published"
                    name="is_published" @if (old('is_published', $project->is_published)) checked @endif>
                <label class="form-check-label" for="is_published">Pubblicato</label>
            </div>

        </div>
    </div>

</div>



{{-- Bottone --}}
<footer class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-floppy-disk"></i>
    </button>
</footer>
</form>

@section('scripts')
    {{-- ! Script per la gestione dello slug --}}
    <script>
        //Prendo gli elementi dal dom
        const slugInput = document.getElementById('slug');
        const titleInput = document.getElementById('title');

        // Metto un event listner al title (uso ' blur ', quando esco dal focus incomincia l'azione)

        titleInput.addEventListener('blur', () => {
            slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
        })
    </script>





    {{-- ! Script per la gestione dell'anteprima immagine --}}
    <script>
        // Creo una constante d'appoggio
        const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

        // Prendo gli elementi dal dom
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('img-preview');

        // Ascolto il cambio del caricamento file
        imageInput.addEventListener('change', () => {
            // Controllo se ho caricato un file
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0])

                // Quando sei pronto (ossia quando ha preparato il dato, promemoria: onload è un 'addeventlistener')
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                }

            } else imagePreview.src = placeholder;
        })
    </script>
@endsection
