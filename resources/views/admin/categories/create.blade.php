@extends('layouts.app')

@section('title', 'Aggiungi categoria')

@section('content')
    <header>
        <h1 class="my-5 text-white">Add Project:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.categories.form')
@endsection
