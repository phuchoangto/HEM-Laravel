@extends('layout')

@section('title', 'Search')

@section('content')

<div class="container mt-5">
    <div class="row row-cols-1  g-4 mt-5">
        <form action="/search/student" method="post" id="searchForm">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter the student ID" name="search" id="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>
    @if($flag == true && !empty($checkins))
    @if (isset($checkins[0]))
    <h1 id="search-result" class="fw-bold">Welcome {{$checkins[0]->student->name}}</h1>
    <p>Below are the events you have attended and checked-in. <br>
        Click on the event below for event details</p>
    @else
    <h1 id="search-result" class="fw-bold">No events have been checked in by student</h1>
    @endif
    @else
    <h1 id="search-result" class="fw-bold"></h1>
    @endif
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        @foreach($checkins as $checkin)
        <div class="col">
            <input type="hidden" id="event_id" value="{{$checkin->event->id}}">
            <input type="hidden" id="student_id" value="{{$checkin->student->id}}">
            <div class="card h-100">
                <a href="/event/{{$checkin->event->id}}">

                    <img src="{{Storage::url($checkin->event->image) }}" class="card-img-top" alt="Event image" height="200px" />
                    <div class="card-body">
                        <h5 class="card-title">{{$checkin->event->name}}</h5>
                        <p class="card-text">
                            {{Str::limit(strip_tags($checkin->event->description) , 50)}}
                        </p>
                    </div>
                </a>
                <div class="card-footer text-muted">
                    {{Carbon\Carbon::parse($checkin->event->start_at)->diffForHumans()}}
                    <a href="/dashboard/events/{{$checkin->event->id}}/students/{{$checkin->student->id}}/certificate">
                        <button class="btn btn-outline-warning btn-rounded btn-sm ml-3 fw-bold text-warning">
                            <i class="fas fa-certificate"></i>&nbsp Get Certificate
                        </button>
                    </a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $checkins->previousPageUrl() ? '' : 'disabled' }}">
                @if($checkins->currentPage() >= 2)
                <a class="page-link" href="?page={{ $checkins->currentPage() - 1}}" tabindex="-1" aria-disabled="{{ $checkins->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
                @endif
            </li>
            @for($i=1;$i<=$checkins->lastPage();$i++)
                <li class="page-item {{ $checkins->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="?page={{$i}}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $checkins->nextPageUrl() ? '' : 'disabled' }}">
                    @if($checkins->currentPage() < $checkins->lastPage())
                        <a class="page-link" href="?page={{ $checkins->currentPage() + 1}}" aria-disabled="{{ $checkins->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                        @endif
                </li>
        </ul>
    </nav>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#search').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/search/student",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#search-result').html('Events have been checked in by student ');
                    $('#tbody').html(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
        $('#btn-certificate').click(function() {
            var event_id = $('#event_id').val();
            var student_id = $('#student_id').val();
            $.ajax({
                url: '/dashboard/events/' + event_id + '/students/' + student_id + '/certificate',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    window.location.href = '/dashboard/events/' + event_id + '/students/' + student_id + '/certificate';
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
@endsection