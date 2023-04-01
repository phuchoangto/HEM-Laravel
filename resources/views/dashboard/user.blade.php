@extends('dashboard')

@section('title', 'User')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" data-mdb-toggle="modal" data-mdb-target="#addUser" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</button>
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
                @foreach($users as $user)
                @if(!$user->is_archive)
                <tr data-id="<?= $user->id ?>">
                    <td>
                        <p class="fw-bold mb-1">{{ $user->id }}</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://img.favpng.com/6/14/2/account-icon-avatar-icon-man-icon-png-favpng-d9YxzGw3UPA07dE7sAQyMSiNk.jpg" class="rounded-circle" alt="" style="width: 45px; height: 45px;" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $user->name }}</p>
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                    </td>
                    <td>
                        <button type="button" onclick="showEdit(<?= $user->id ?>)" data-mdb-toggle="modal" data-mdb-target="#editUser" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                            <i class="fas fa-user-edit"></i>&nbsp Edit
                        </button>
                        <button type="button" onclick="deleteUser(<?= $user->id ?>)" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark">
                            <i class="fas fa-trash"></i>&nbsp Delete
                        </button>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                @if($users->currentPage() >= 2)
                <a class="page-link" href="user?page={{ $users->currentPage() - 1}}" tabindex="-1" aria-disabled="{{ $users->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
                @endif
            </li>
            @for($i=1;$i<=$users->lastPage();$i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="/dashboard/user?page={{$i}}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                    @if($users->currentPage() < $users->lastPage())
                        <a class="page-link" href="user?page={{ $users->currentPage() + 1}}" aria-disabled="{{ $users->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                        @endif
                </li>
        </ul>
    </nav>
</div>
@endsection

<!-- Add Modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/user/add" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" />
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
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit student</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/user/edit" method="POST" id="editUser">
                    @csrf
                    <input type="hidden" id="edit_id" name="id" />
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password" />
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
            url: "/dashboard/user/" + id,
            success: function(response) {
                console.log(response);
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#edit_password').val(response.password);
                $('#editUser').show();
            }
        });
    }

    function deleteUser(id) {
        $.ajax({
            type: "DELETE",
            url: "/dashboard/user/" + id,
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
        //add User
        $('#addUser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/dashboard/user/add",
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    $('#addUser').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }

            });
        });
        $('#editUser').submit(function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            $.ajax({
                type: "PUT",
                url: "/dashboard/user/" + id,
                data: {
                    name: $('#edit_name').val(),
                    email: $('#edit_email').val(),
                    password: $('#edit_password').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    $('#editUser').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>

@endsection