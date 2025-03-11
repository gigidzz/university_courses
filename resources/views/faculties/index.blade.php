<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Faculties</h1>

{{--    I added add faculty button--}}
    <a href="{{ route('faculties.create') }}" class="btn btn-success mb-3">Add Faculty</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <ul class="list-group mt-3">
        @foreach ($faculties as $faculty)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('faculties.show', $faculty->id) }}">{{ $faculty->name }}</a>
                    <small class="text-muted d-block">Status: {{ $faculty->formatted_status }}</small>
                    <small class="text-muted d-block">Created: {{ $faculty->formatted_created_at }}</small>
                </div>

                <div>
                    <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        {{ $faculties->links('pagination::bootstrap-4') }}
    </div>
</div>





</body>
</html>
