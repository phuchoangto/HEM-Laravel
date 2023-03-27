@extends('dashboard')

@section('title', 'Student')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addModal">
        Add
    </button>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table align-middle mb-0 bg-white table-bordered">
            <thead class="bg-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr data-id="<?= $student->id ?>">
                    <td>
                        <p class="fw-bold mb-1">{{ $student->id }}</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://png.pngtree.com/png-vector/20190324/ourmid/pngtree-vector-reading-icon-png-image_862313.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px;" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $student->name }}</p>
                                <p class="text-muted mb-0">{{ $student->email }}</p>
                            </div>
                    </td>
                    <td>
                        <button type="button" onclick="showEdit(<?= $student->id ?>)" class="btn btn-link btn-rounded btn-sm fw-bold text-primary" data-mdb-toggle="modal" data-mdb-target="#editModal" data-mdb-ripple-color="dark">
                            <i class="fas fa-edit"></i>&nbsp Edit
                        </button>
                        <button type="button" onclick="deleteStudent(<?= $student->id ?>)" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark">
                            <i class="fas fa-trash"></i>&nbsp Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add student</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/student/add" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Student ID</label>
                        <input type="number" class="form-control" id="student_id" name="student_id" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Faculty</label>
                        <input type="number" class="form-control" id="faculty_id" name="faculty_id" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit student</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/student/edit" method="POST" id="editStudent">
                    @csrf
                    <input type="hidden" id="edit_id" name="id" />
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Student ID</label>
                        <input type="number" class="form-control" id="edit_student_id" name="student_id" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Faculty</label>
                        <input type="number" class="form-control" id="edit_faculty_id" name="faculty_id" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    function showEdit(id) {
        $.ajax({
            type: "GET",
            url: "/dashboard/student/" + id,
            success: function(response) {
                console.log(response);
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_student_id').val(response.student_id);
                $('#edit_email').val(response.email);
                $('#edit_faculty_id').val(response.faculty_id);
                $('#editModal').show();
            }
        });
    }

    function deleteStudent(id) {
        $.ajax({
            type: "DELETE",
            url: "/dashboard/student/" + id,
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response.message);
                console.log(response);
                location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    $(document).ready(function() {
        //addStudent submit
        $('#addStudent').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/dashboard/student/add",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                }
            });
        });
        $('#editStudent').submit(function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            $.ajax({
                type: "PUT",
                url: "/dashboard/student/" + id,
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    $('#editModal').modal('hide');
                }
            });
        });
    });
</script>

@endsection