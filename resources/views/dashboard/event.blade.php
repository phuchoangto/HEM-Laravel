@extends('dashboard')

@section('title', 'Event')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</button>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table align-middle mb-0 bg-white table-bordered">
            <thead class="bg-light">
                <tr class="align-text-center">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class = "col-1">Location</th>
                    <th class = "col-2">Time</th>
                    <th class = "col-2">Image</th>
                    <th class = "col-1">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>
                    <p class="fw-bold mb-1">{{ $event->id }}</p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/2558/2558944.png" alt="" style="width: 45px; height: 45px;" />
                            <div class="ms-3">
                                <p class="fw-bold">{{ $event->name }}</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="ms-3">
                                <p class="fw-bold mb-0">{{ $event->description }}</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="ms-3">
                                <p class="fw-bold mb-0">{{ $event->location }}</p>
                        </div>
                    </td>
                    <td >
                        <div>
                            <div class="ms-3">
                                <p class="text-muted mb-0">{{ $event->start_at }} </br> {{ $event->end_at}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                                <img src="{{ $event->image }}" alt="" style="width:185px; height: 120px;" />
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark" style="margin-bottom:15px;">
                            <i class="fas fa-user-edit"></i>&nbsp Edit
                        </button>
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
