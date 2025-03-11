<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $faculty->name }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
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
</div>

</body>
</html>
