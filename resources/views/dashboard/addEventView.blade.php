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
                <form action="/dashboard/event/add" method="POST" enctype="multipart/form-data" id="addEventForm">
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
                                    <input type="number" class="form-control" id="faculty_id" name="faculty_id" placeholder="Enter Faculty">
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
                            <textarea class="form-control" id="description" name="description" rows="9"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="start_at" class="col-sm-3 col-form-label">Start at</label>
                                <input type="datetime-local" class="form-control" id="start_at" name="start_at">
                            </div>
                            <div class="col-sm-3">
                                <label for="end_at" class="col-sm-3 col-form-label">End at</label>
                                <input type="datetime-local" class="form-control" id="end_at" name="end_at">
                            </div>
                            <div class="col-sm-6">
                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image">
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
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        //add event
        $('#addEvent').on('click', function() {
            var postData = new FormData($("#addEventForm")[0]);
            $.ajax({
                type: "POST",
                url: "/dashboard/event/add",
                data: postData,
                success: function(data) {
                    console.log(data);
                    alert("Data Saved");
                    $('#addEventModal').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                    alert("Data Not Saved");
                    $('#addEventModal').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>