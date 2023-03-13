@extends('layouts.app')

@section('title', 'Edit categoria')

@section('content')
    <header>
        <h1 class="my-5 text-white">Edit Project:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.categories.form')
@endsection
