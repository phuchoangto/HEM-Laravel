@extends('dashboard')
@inject('carbon', 'Carbon\Carbon')
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
                                <p class="fw-bold">{{Str::limit(strip_tags($event->name) , 50)}}</p>
                            </div>
                    </td>
                    <td>
                        <div>
                            <div class="float-left">
                                <p class="fw-bold mb-0"> {{Str::limit(strip_tags($event->description) , 50)}} </p>
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
                                <p class="text-muted mb-0">
                                    {{ $carbon::parse($event->start_at)->format('d/m/Y H:i') }}
                                    <br><br>
                                    {{ $carbon::parse($event->end_at)->format('d/m/Y H:i') }}
                                </p>
                            </div>
                    </td>
                    <td>
                        <div style="object-fit:cover;">
                            <img src="{{Storage::url($event->image)}}" alt="" style="width:220px;height:180px;" />
                        </div>
                    </td>
                    <td>
                        <a href="/dashboard/events/{{$event->id}}/students" class="btn btn-link btn-rounded btn-sm fw-bold text-warning">
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
        <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $events->previousPageUrl() ? '' : 'disabled' }}">
                    @if($events->currentPage() >= 2)
                    <a class="page-link" href="event?page={{ $events->currentPage() - 1}}" tabindex="-1" aria-disabled="{{ $events->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
                    @endif
                </li>
                @for($i=1;$i<=$events->lastPage();$i++)
                    <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="/dashboard/event?page={{$i}}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item {{ $events->nextPageUrl() ? '' : 'disabled' }}">
                        @if($events->currentPage() < $events->lastPage())
                            <a class="page-link" href="event?page={{ $events->currentPage() + 1}}" aria-disabled="{{ $events->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                            @endif
                    </li>
            </ul>
        </nav>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function init() {
        initCKEditor();
    }
    var editorDescription = null;

    function initCKEditor() {
        ClassicEditor
            .create(document.querySelector('#edit_description'), {
                ckfinder: {
                    uploadUrl: '/dashboard/upload?_token={{ csrf_token() }}',
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'uploadImage',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
            })
            .then(editor => {
                editorDescription = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }

    function setDataCKEditor(string) {
        if (editorDescription != null) {
            editorDescription.setData(string);
        } else {
            initCKEditor();
            setTimeout(function() {
                editorDescription.setData(string);
            }, 1000);
        }
    }
</script>
<script>
    $event_image = null;

    function showEdit(id) {
        $.ajax({
            type: "GET",
            url: "/dashboard/event/" + id,
            success: function(response) {
                console.log(response);
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                setDataCKEditor(response.description);
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
        Swal.fire({
            title: 'Do you want to delete this event?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Deleted!', '', 'success')
                $.ajax({
                    type: "DELETE",
                    url: "/dashboard/event/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Event is not deleted', '', 'info')
            }
        })
    }

    function selectImage() {
        $('#edit_image_save').click();
        $('#edit_image_save').change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
    }
    $(document).ready(function() {
        $('#editEvent').submit(function(e) {
            e.preventDefault();
            var postData = new FormData($("#editEventForm")[0]);
            var id = $('#edit_id').val();
            $.ajax({
                type: "POST",
                url: "/dashboard/event/" + id,
                data: postData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        title: 'Saved!',
                        confirmButtonText: 'OK',
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#editEvent').modal('hide');
                            location.reload();
                        }
                    })
                },
                error: function(data) {
                    console.log(data);
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
                <form action="dashboard/event/" method="POST" id="editEventForm" enctype="multipart/form-data">
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
                        <select class="form-select" id="edit_faculty_id" name="faculty_id">
                            <option selected>Choose...</option>
                            @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
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
                        <img onclick="selectImage()" id="edit_image" name="edit_image" style="width:220px;height:180px;" />
                        <input type="file" class="form-control" id="edit_image_save" name="image" style="display: none;">
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