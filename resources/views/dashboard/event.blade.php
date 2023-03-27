@extends('dashboard')

@section('title', 'Event')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" data-mdb-toggle="modal" data-mdb-target="#addEvent" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</button>
</div>
@include('dashboard.actions.addEvent')
<div class="card">
    <div class="card-body p-0">
        <table class="table align-middle mb-0 bg-white table-bordered">
            <thead class="bg-light">
                <tr class="align-text-center">
                    <th>Id</th>
                    <th class = "col-2">Name</th>
                    <th class = "col-3">Description</th>
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
                            <div class="float-left">
                                <p class="fw-bold">{{ $event->name }}</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="float-left">
                                <p class="fw-bold mb-0">{{ $event->description }}</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="float-left">
                                <p class="fw-bold mb-0">{{ $event->location }}</p>
                        </div>
                    </td>
                    <td >
                        <div>
                            <div class="float-left">
                                <p class="text-muted mb-0">{{ $event->start_at }} </br> {{ $event->end_at}}</p>
                        </div>
                    </td>
                    <td>
                        <div style="object-fit:cover;">
                                <img src="{{ $event->image }}" alt=""  style="width:220px;height:180px;"/>
                        </div>
                    </td>
                    <td>
                        <button type="button" data-mdb-toggle="modal" data-mdb-target="#editEvent" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark"  style="margin-bottom:15px;">
                            <i class="fas fa-user-edit"></i>&nbsp Edit
                        </button>
                        @include('dashboard.actions.editEvent')
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
