@extends('layouts.app')

@section('title', $faculty->name)

@section('content')
    <h1>{{ $faculty->name }}</h1>
    <p><strong>Description:</strong> {{ $faculty->description }}</p>
    <p><strong>Status:</strong> {{ ucfirst($faculty->status) }}</p>

    <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Back to Faculties</a>
    <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection
