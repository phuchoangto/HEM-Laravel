@extends('dashboard')

@section('title', 'Event')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <button type="button" data-mdb-toggle="modal" data-mdb-target="#addEvent" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</button>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table align-middle mb-0 bg-white table-bordered">
            <thead class="bg-light">
                <tr class="align-text-center">
                    <th>Id</th>
                    <th class="col-2">Name</th>
                    <th class="col-3">Description</th>
                    <th class="col-1">Location</th>
                    <th class="col-2">Time</th>
                    <th class="col-2">Image</th>
                    <th class="col-1">Actions</th>
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
                    <td>
                        <div>
                            <div class="float-left">
                                <p class="text-muted mb-0">{{ $event->start_at }} </br> {{ $event->end_at}}</p>
                            </div>
                    </td>
                    <td>
                        <div style="object-fit:cover;">
                            <img src="{{ $event->image }}" alt="" style="width:220px;height:180px;" />
                        </div>
                    </td>
                    <td>
                        <button type="button" data-mdb-toggle="modal" data-mdb-target="#editEvent" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark" style="margin-bottom:15px;">
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
    <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $events->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $events->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $events->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
            </li>
            @for($i=1;$i<=$events->lastPage();$i++)
                <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $events->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-disabled="{{ $events->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                </li>
        </ul>
    </nav>
</div>
@endsection


<!-- Add -->
<div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new event</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/event/add" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                    </div>
                    <div class="mb-3">
                        <label for="start_at" class="form-label">Start at</label>
                        <input type="datetime-local" class="form-control" id="start_at" name="start_at">
                    </div>
                    <div class="mb-3">
                        <label for="end_at" class="form-label">End at</label>
                        <input type="datetime-local" class="form-control" id="end_at" name="end_at">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('js')
<script>
    $(document).ready(function() {

        $('#addEvent').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/dashboard/event/add',
                //csrf
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    location: $('#location').val(),
                    start_at: $('#start_at').val(),
                    end_at: $('#end_at').val(),
                    image: $('#image').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>

@endsection