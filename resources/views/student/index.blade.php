<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Crud</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar bg-dark border-bottom border-body">
            <div class="container">
                <a class="navbar-brand text-white fw-semibold" href="{{ route('student.index') }}">Student</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="d-flex align-items-center justify-content-between mt-5">
            <h3 class="fw-semibold">Student list</h3>
            <a class="btn btn-primary" href="{{ route('student.create') }}">Add Student</a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="table mt-3">
            <table class="table table-striped border align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($students->isNotEmpty())
                        @foreach ($students as $student)
                            <tr>
                                <th scope="row">{{ $student->id }}</th>
                                <th>{{ $student->name }}</th>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->address }}</td>
                                <td>
                                    @if ($student->image != '' && file_exists(public_path() . '/uploads/students/' . $student->image))
                                        <img src="{{ url('uploads/students/' . $student->image) }}"
                                            alt="{{ $student->name }}"
                                            style="width: 60px; height:60px; border-radius: 50%; object-fit:cover;">
                                    @else
                                        <img src="{{ url('img/demo-profile.png') }}" alt="{{ $student->name }}"
                                            style="width: 60px; height:60px; border-radius: 50%; object-fit:cover;">
                                    @endif
                                </td>
                                <td>1</td>
                                <td>
                                    <a href="" class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </main>
</body>

</html>
