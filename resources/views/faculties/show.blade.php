@extends('layouts.app')

@section('title', $faculty->name)

@section('content')
    <h1>{{ $faculty->getName() }}</h1>
    <p><strong>Description:</strong> {{ $faculty->getDescription() }}</p>
    <p><strong>Status:</strong> {{ ucfirst($faculty->getStatus()) }}</p>

    <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Back to Faculties</a>
    <a href="{{ route('faculties.edit', $faculty->getId()) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('faculties.destroy', $faculty->getId()) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
