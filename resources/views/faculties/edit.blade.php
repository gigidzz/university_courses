@extends('layouts.app')

@section('title', 'Edit Faculty')

@section('content')
    <h1>Edit Faculty</h1>

    <form action="{{ route('faculties.update', $faculty->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $faculty->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $faculty->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $faculty->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $faculty->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
