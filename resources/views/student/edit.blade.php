<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@12">
</head>

<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-body">
            <div class="container">
                <a class="navbar-brand text-white fw-semibold" href="{{ route('student.index') }}">Product</a>
            </div>
        </nav>
    </header>

    <main class="container">

        <h3 class="mt-5">Edit Student</h3>

        <form method="post" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data"
            class="mt-3 needs-validation" novalidate>
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    id="name" value="{{ old('name', $student->name) }}">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('name', $student->email) }}">
                @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" id="address" cols="30" rows="5">{{ old('name', $student->address) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Profile picture</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="image">
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('student.index') }}" class="btn btn-dark">Cancle</a>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
