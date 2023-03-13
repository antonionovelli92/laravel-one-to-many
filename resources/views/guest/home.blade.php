@extends('layouts.app')
@section('title', 'Home-guest')

@section('content')
    <header class="mt-5">
        @if ($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </header>

    @forelse ($projects as $project)
        <div class="card my-5  ">
            <div class="card-header">
                {{ $project->created_at }}
            </div>
            <div class="card-body p-5">
                <div class="row">
                    @if ($project->image)
                        <div class="col-3">
                            <img class="img-fluid" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        </div>
                    @endif
                </div>
                <div class="col">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p class="card-text">{{ $project->content }}</p>
                </div>
            </div>
        </div>
    @empty
        <h1 class="text-center">Non ci sono progetti disponibili </h1>
    @endforelse



@endsection
