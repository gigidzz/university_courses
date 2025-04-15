@extends('layouts.app')

@section('title', 'Edit Faculty')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Edit Faculty</h1>

    <form action="{{ route('faculties.update', $faculty->getId()) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $faculty->getName() }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $faculty->getDescription() }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $faculty->getStatus() == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $faculty->getStatus() == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
