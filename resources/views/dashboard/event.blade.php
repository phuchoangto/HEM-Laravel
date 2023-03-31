@extends('dashboard')

@section('title', 'Event')

@section('content')
<div class="d-flex flex-row-reverse mb-3">
    <a href="/dashboard/addEventView" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp ADD</a>
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
                @if(!$event->is_archive)
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
                            <img src="{{Storage::url($event->image)}}" alt="" style="width:220px;height:180px;" />
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.checkin', $event->id) }}" class="btn btn-link btn-rounded btn-sm fw-bold text-warning">
                            <i class="fas fa-check"></i>&nbsp Check
                        </a>
                        <button type="button" onclick="showEdit(<?= $event->id ?>)" data-mdb-toggle="modal" data-mdb-target="#editEvent" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark" style="margin-bottom:10px;margin-top:10px">
                            <i class="fas fa-user-edit"></i>&nbsp Edit
                        </button>
                        <button type="button" onclick="deleteEvent(<?= $event->id ?>)" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark">
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

@section('js')
<script>
    function showEdit(id) {
        $.ajax({
            type: "GET",
            url: "/dashboard/event/" + id,
            success: function(response) {
                console.log(response);
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_description').val(response.description);
                $('#edit_faculty_id').val(response.faculty_id);
                $('#edit_location').val(response.location);
                $('#edit_start_at').val(response.start_at);
                $('#edit_end_at').val(response.end_at);
                $('#edit_image').attr('src', `{{ Storage::url('${response.image}') }}`);
                $('#editEvent').show();
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function deleteEvent(id) {
        $.ajax({
            type: "DELETE",
            url: "/dashboard/event/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

    function selectImage() {
        // Mở hộp tệp để chọn ảnh mới
        $('<input type="file"> accept="image/*">').on('change', function() {
            // Đảm bảo rằng tệp được chọn là một hình ảnh
            if (this.files[0].type.match(/^image\//)) {
                // Đọc URL của tệp được chọn
                var reader = new FileReader();
                reader.onload = function() {
                    // Cập nhật src của thẻ hình ảnh để hiển thị ảnh mới
                    $('#edit_image').attr('src', reader.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        }).click();
    }
    $(document).ready(function() {
        /*$('#addEvent').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/dashboard/event/add',
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
                    faculty_id: $('#faculty_id').val(),
                },
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    $('#addEvent').modal('hide');
                    location.reload;
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });*/
        $('#editEvent').submit(function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            $.ajax({
                type: "PUT",
                url: "/dashboard/event/" + id,
                data: {
                    name: $('#edit_name').val(),
                    description: $('#edit_description').val(),
                    location: $('#edit_location').val(),
                    faculty_id: $('#edit_faculty_id').val(),
                    start_at: $('#edit_start_at').val(),
                    end_at: $('#edit_end_at').val(),
                    image: $('#edit_image').attr('src'),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                    $('#editEvent').modal('hide');
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

<!-- Edit -->
<div class="modal fade" id="editEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit event</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="dashboard/event/" method="POST" id="editEvent">
                    @csrf
                    <input type="hidden" id="edit_id" name="id" />
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="edit_location" name="location" placeholder="Enter location">
                    </div>
                    <div class="mb-3">
                        <label for="faculty_id" class="form-label">Faculty</label>
                        <input type="text" class="form-control" id="edit_faculty_id" name="faculty_id" placeholder="Enter Faculty ID">
                    </div>
                    <div class="mb-3">
                        <label for="start_at" class="form-label">Start at</label>
                        <input type="datetime-local" class="form-control" id="edit_start_at" name="start_at">
                    </div>
                    <div class="mb-3">
                        <label for="end_at" class="form-label">End at</label>
                        <input type="datetime-local" class="form-control" id="edit_end_at" name="end_at">
                    </div>
                    <div style="object-fit:cover; text-align: center;">
                        <img onclick="selectImage()" id="edit_image" alt="" style="width:220px;height:180px;" />
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