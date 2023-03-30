@extends('dashboard')

@section('title', 'Add New Event')

@section('content')
<!-- Add -->
<div class="pt-2" style="text-align: center;">
    <h1 class="text-primary" style="font-weight: bold;font-family: 'georgia';">Create Event</h1>
    <hr style="height: 6px;background-image: radial-gradient(closest-side, gray, rgba(128, 128, 128, 0) 100%);position: relative;border: 0;margin: 1.35em auto;max-width: 100%;background-position: 50%;box-sizing: border-box;">
</div>
<div class="card">
    <div class="card-body">
        <div class="table align-middle mb-0 bg-white table-bordered" style="border-radius:16px;">
            <div class="modal-body">
                <form action="/dashboard/event/add" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div>
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                    </div>
                    <div>
                        <label for="faculty_id" class="form-label">Faculty</label>
                        <input type="number" class="form-control" id="faculty_id" name="faculty_id" placeholder="Enter Faculty">
                    </div>
                    <div>
                        <label for="start_at" class="form-label">Start at</label>
                        <input type="datetime-local" class="form-control" id="start_at" name="start_at">
                    </div>
                    <div>
                        <label for="end_at" class="form-label">End at</label>
                        <input type="datetime-local" class="form-control" id="end_at" name="end_at">
                    </div>
                    <div>
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
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

<script>
    $(document).ready(function() {
        //add event
        $('#addEvent').on('click', function() {
            $.ajax({
                type: "POST",
                url: "/dashboard/event/add",
                data: {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    location: $('#location').val(),
                    faculty_id: $('#faculty_id').val(),
                    start_at: $('#start_at').val(),
                    end_at: $('#end_at').val(),
                    image: $('#image').val(),
                },
                success: function(response) {
                    console.log(response);
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