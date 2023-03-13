@extends('layouts.app')

@section('title', 'Aggiungi progetto')

@section('content')
    <header>
        <h1 class="my-5 text-white">Add Project:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.projects.form')
@endsection
