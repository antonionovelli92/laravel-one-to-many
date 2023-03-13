@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1 class="my-5 text-white">Categorie:</h1>
        {{-- Bottone add --}}
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
    </header>


    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Colore</th>
                <th scope="col">Creato il</th>
                <th scope="col">Aggiornato il</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->label }}</td>
                    <td>{{ $category->color }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    {{-- Bottoni --}}
                    <td>
                        <div class="d-flex justify-content-end align-items-center">

                            {{-- ? Btn-modifica --}}
                            <a class="btn btn-warning ms-2" href="{{ route('admin.categories.edit', $category->id) }}">
                                <i class="fa-solid fa-edit text-white"></i>
                            </a>
                            {{-- ? Btn-elmina --}}
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" class="delete-form"
                                method="POST" data-entity="categoria">
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
                <tr scope='row' colspan='9' class="text-center">Non ci sono categorie</tr>
            @endforelse

        </tbody>
    </table>
    <footer>
        <div class="d-flex justify-content-end mt-5">
            @if ($categories->hasPages())
                {{ $categories->links() }}
            @endif
        </div>

    </footer>
@endsection
@section('scripts')



@endsection
