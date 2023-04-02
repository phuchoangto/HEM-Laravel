@extends('layout')

@section('title', 'Search')

@section('content')

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
        <form action="/search/student" method="post" id="searchForm">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Event</th>
                    <th scope="col">Check in at</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($checkins as $checkin)
                <tr>
                    <td>{{$checkin->student->student_id}}</td>
                    <td>{{$checkin->event->name}}</td>
                    <td>{{$checkin->check_in_at}}</td>
                </tr>
                @endforeach
            </tbody>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#search').on('submit', function(e) {
            e.preventDefault();
            var search = $('#search').val();
            $.ajax({
                type: "POST",
                url: "/search/student",
                data: {
                    _token: '{{ csrf_token() }}',
                    search: search
                },
                success: function(response) {
                    //change
                    $('#tbody').html(response);
                }
            });
        });
    });
</script>
@endsection