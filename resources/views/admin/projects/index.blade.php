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
        <div class="col-md-2">
            <form action="{{ route('admin.projects.index') }}" method="GET">
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="submit">Filtra</button>
                    <select class="form-select" name="filter">
                        <option selected value="">Tutte...</option>
                        <option value="published">Pubblicati</option>
                        <option value="drafts">Bozze</option>
                    </select>
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
                <th scope="col">Description</th>
                <th scope="col">Slug</th>
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
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->slug }}</td>
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
    </footer>
@endsection
@section('scripts')



@endsection
