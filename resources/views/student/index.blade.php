<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Crud</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">


    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
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
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })
                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('success') }}"
                })
            </script>
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
                                <th scope="row">
                                    {{ $loop->iteration + $students->perPage() * ($students->currentPage() - 1) }}</th>
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
                                <td>
                                    <a href="{{ route('student.edit', $student->id) }}"
                                        class="btn btn-success">Edit</a>
                                    <a href="#" onclick="deleteStudent({{ $student->id }})"
                                        class="btn btn-danger">Delete</a>

                                    <form id="deleteId{{ $student->id }}"
                                        action="{{ route('student.destroy', $student->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        {{ $students->links() }}
    </main>
    <script>
        function deleteStudent(id) {
            if (confirm("Are you sure?")) {
                document.getElementById('deleteId' + id).submit();
            }
        }
    </script>
</body>

</html>
