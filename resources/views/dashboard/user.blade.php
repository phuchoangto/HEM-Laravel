@extends('dashboard')

@section('title', 'User')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" data-mdb-toggle="modal" data-mdb-target="#addUser" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</button>
</div>
@include('dashboard.actions.addUser')
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
                <tr>
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
                        <button type="button" data-mdb-toggle="modal" data-mdb-target="#editUser" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                            <i class="fas fa-user-edit"></i>&nbsp Edit
                        </button>
                        @include('dashboard.actions.editUser')
                        <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark">
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
