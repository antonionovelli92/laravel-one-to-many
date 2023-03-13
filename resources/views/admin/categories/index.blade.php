@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1 class="my-5 text-white">Projects:</h1>
        {{-- Bottone add --}}
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
    </header>
    {{-- filtro --}}
    <div class="row d-flex justify-content-end align-items-center">
        <div class="col-md-2 ">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="d-flex align-item-center">
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="submit">Filtra</button>
                    <select class="form-select" name="status_filter">
                        <option selected value="">Tutte...</option>
                        <option @if ($status_filter === 'published') selected @endif value="published">Pubblicati</option>
                        <option @if ($status_filter === 'drafts') selected @endif value="drafts">Bozze</option>
                    </select>
                    <div class="input-group mt-3">
                        <select class="form-select" name="category_filter" id="category_filter">
                            <option value="" selected>Tutte le categoria</option>
                            @foreach ($categories as $category)
                                <option @if ($category_filter == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->label }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Categoria</th>
                {{-- <th scope="col">Description</th> --}}
                {{-- <th scope="col">Slug</th> --}}
                <th scope="col">Stato</th>
                <th scope="col">Link</th>
                <th scope="col">Creato il</th>
                <th scope="col">Aggiornato il</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->author }}</td>
                    {{-- ! Null operator il punto interrogativo
                    <td>{{ $project->category?->label }}</td> --}}
                    <td>
                        @if ($project->category)
                            <span class="badge"
                                style="background-color: {{ $project->category->color }}">{{ $project->category->label }}</span>
                        @else
                            -
                        @endif

                    </td>
                    {{-- <td>{{ $project->description }}</td> --}}
                    {{-- <td>{{ $project->slug }}</td> --}}
                    <td>
                        <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline">
                                <i
                                    class="fas fa-toggle-{{ $project->is_published ? 'on' : 'off' }} {{ $project->is_published ? 'text-success' : 'text-danger' }}"></i>

                            </button>
                        </form>
                    </td>
                    <td>{{ $project->url_project }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                    {{-- Bottoni --}}
                    <td>
                        <div class="d-flex justify-content-end align-items-center">
                            {{-- ? Btn-dettaglio --}}
                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-small btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            {{-- ? Btn-modifica --}}
                            <a class="btn btn-warning ms-2" href="{{ route('admin.projects.edit', $project->id) }}">
                                <i class="fa-solid fa-edit text-white"></i>
                            </a>
                            {{-- ? Btn-elmina --}}
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" class="delete-form"
                                method="POST" data-entity="progetto">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger  ms-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr scope='row' colspan='9' class="text-center">Non ci sono progetti</tr>
            @endforelse

        </tbody>
    </table>
    <footer>
        <div class="d-flex justify-content-end mt-5">
            @if ($projects->hasPages())
                {{ $projects->links() }}
            @endif
        </div>

        {{-- progetti per catehorie --}}
        <section id="categories-projects" class="my-5 text-white">
            <hr>
            <h2 class="mb-5 shadow text">Projects by Categories</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col">
                        <h3 class="my-3 text-secondary">
                            {{ $category->label }} <small>({{ count($category->projects) }})</small>
                        </h3>
                        @forelse ($category->projects as $project)
                            <div>
                                <a class="text-decoration-none text-white"
                                    href="{{ route('admin.projects.show', $project->id) }}">{{ $project->title }}</a>
                            </div>

                        @empty
                            -
                        @endforelse
                    </div>
                @endforeach

            </div>


        </section>
    </footer>
@endsection
@section('scripts')



@endsection
