@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <header>
        <h1 class="my-5 text-white">
            {{ $project->title }}
        </h1>
        <div class="projects">
            <div class="project">
                <a href="#project-1">
                    @if ($project->image)
                        <img class="img-fluid" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                    @endif
                    <h2>{{ $project->title }}</h2>
                </a>
                <a href="{{ $project->url_project }}" class="btn btn-small btn-primary p-0 mb-2">Visualizza il progetto</a>
                <a href="{{ $project->url_generic }}" class="btn btn-small btn-secondary p-0">Visualizza il link generico</a>


                {{-- Bottoni --}}
                <div class="d-flex justify-content-start mt-5">
                    {{-- ? Btn-torna-indietro --}}
                    <a class="btn btn-success rounded-5" href="{{ route('admin.projects.index') }}">
                        <i class="fa-solid fa-arrow-left text-white"></i>
                    </a>
                    {{-- ? Btn-modifica --}}
                    <a class="btn btn-warning rounded-5 ms-2" href="{{ route('admin.projects.edit', $project->id) }}">
                        <i class="fa-solid fa-edit text-white"></i>
                    </a>
                    {{-- ? Btn-elimina --}}
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form"
                        data-entity="progetto">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-5 ms-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </div>
                <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="mt-3 btn btn-{{ $project->is_published ? 'danger' : 'success' }}">
                        {{ $project->is_published ? 'Metti in bozza' : 'Pubblica' }}
                    </button>
                </form>
                {{-- ! Null operator il punto interrogativo --}}
                @if ($project->category?->label)
                    <span class="badge rounded-pill text-bg-info mt-4">{{ $project->category?->label }}</span>
                @else
                    -
                @endif
            </div>

        </div>

        <div class="project-show text-bg-dark rounded-5" id="project-1">
            <div class="project-details">
                <h2>{{ $project->title }}</h2>
                <p>{{ $project->description }}</p>
                <div class="project-content">
                    {!! $project->content !!}
                </div>
                <h6><strong>Autore:</strong> {{ $project->author }}</h6>
                <div class="d-flex justify-content-between">
                    <strong>Creato:</strong> <time>{{ $project->created_at }}</time>
                    <strong>Aggiornato:</strong> <time> {{ $project->updated_at }}</time>
                    <strong>Stato:</strong> {{ $project->is_published ? 'Pubblicato' : 'Bozza' }}


                </div>

            </div>
        </div>

    </header>
@endsection
