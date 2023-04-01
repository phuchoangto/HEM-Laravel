@extends('dashboard')

@section('title', 'Add New Event')

@section('content')
<!-- Add -->
<div class="pt-2" style="text-align: center;">
    <h1 class="text-primary" style="font-weight: bold;">Create Event</h1>
    <hr style="height: 6px;background-image: radial-gradient(closest-side, gray, rgba(128, 128, 128, 0) 100%);position: relative;border: 0;margin: 1.35em auto;max-width: 100%;background-position: 50%;box-sizing: border-box;">
</div>
<div class="card">
    <div class="card-body">
        <div class="table align-middle mb-0 bg-white table-bordered" style="border-radius:16px;">
            <div class="modal-body">
                <form action="/dashboard/addEventView" method="POST" enctype="multipart/form-data" id="addEventForm">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="faculty_id" class="col-sm-3 col-form-label">Faculty</label>
                                    <select class="form-select" id="faculty_id" name="faculty_id">
                                        <option selected>Choose...</option>
                                        @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="location" class="col-sm-4 col-form-label">Location</label>
                                    <textarea type="text" class="form-control" id="location" name="location" rows="3" placeholder="Enter location"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pt-1 col-sm-8">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="editor" name="description" rows="9"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col">
                                <div class="col-sm-5">
                                    <label for="start_at" class="col-sm-3 col-form-label">Start at</label>
                                    <input type="datetime-local" class="form-control" id="start_at" name="start_at">
                                </div>
                                <div class="col-sm-5">
                                    <label for="end_at" class="col-sm-3 col-form-label">End at</label>
                                    <input type="datetime-local" class="form-control" id="end_at" name="end_at">
                                </div>

                            </div>
                            <div class="col-sm-6 mt-3">
                                <div style="object-fit:cover; text-align: left;">
                                    <img onclick="selectImage()" id="edit_image" name="edit_image" style="width:220px;height:180px;" />
                                    <input type="file" class="form-control" id="edit_image_save" name="image" accept="image" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="event"><button type="button" class="btn btn-secondary">Back</button></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{route('ckeditor.upload').'?_token='.csrf_token()}}",
            },
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
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
        //add event
        $('#addEventForm').submit(function(e) {
            e.preventDefault();
            var postData = new FormData($("#addEventForm")[0]);
            $.ajax({
                type: "POST",
                url: "/dashboard/addEventView",
                data: postData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    window.location.href = "/dashboard/event";
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>
@endsection