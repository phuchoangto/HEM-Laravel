@extends('dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="container ">
    <section>
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Total Events</h4>
                                    <p class="mb-0">All events of School</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Total_event">84,695</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fas fa-book text-warning fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Current Events</h4>
                                    <p class="mb-0">Current events of School</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Current_event">3</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-plus text-danger fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Upcoming Events</h4>
                                    <p class="mb-0">Events that will appear in the future</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Upcoming_event">84,695</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="far fa-user text-primary fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Total Students</h4>
                                    <p class="mb-0">Total number of students at the school</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Total_student">3</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-check text-success fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Student Checked in</h4>
                                    <p class="mb-0">Number of students who checked in</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Checkin_count">84,695</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-md-1">
                            <div class="d-flex flex-row">
                                <div class="align-self-center">
                                    <i class="fas fa-school text-warning fa-3x me-4"></i>
                                </div>
                                <div>
                                    <h4>Total Faculty</h4>
                                    <p class="mb-0">Total number of faculty at the school</p>
                                </div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="h1 mb-0" id="Total_faculty">3</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section: Statistics with subtitles-->
</div>
<!--Main layout-->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/dashboard/statis/eventCount',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Total_event').html(data);
            }
        });
        $.ajax({
            url: '/dashboard/statis/eventCountCurrent',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Current_event').html(data);
            }
        });
        $.ajax({
            url: '/dashboard/statis/eventCountUpcoming',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Upcoming_event').html(data);
            }
        });
        $.ajax({
            url: '/dashboard/statis/studentCount',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Total_student').html(data);
            }
        });
        $.ajax({
            url: '/dashboard/statis/checkinCount',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Checkin_count').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
        $.ajax({
            url: '/dashboard/statis/facultyCount',
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#Total_faculty').html(data);
            }
        });
    });
</script>
@endsection