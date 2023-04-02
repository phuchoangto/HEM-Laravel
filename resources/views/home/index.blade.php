@extends('layout')

@section('title', 'Home')

@section('content')

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
        @foreach($events as $event)
        <div class="col">
            <a href="/event/{{$event->id}}">
                <div class="card h-100">
                    <img src="{{Storage::url($event->image) }}" class="card-img-top" alt="Event image" height="200px" />
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name}}</h5>
                        <p class="card-text">
                            {{Str::limit(strip_tags($event->description) , 50)}}
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        {{Carbon\Carbon::parse($event->start_at)->diffForHumans()}}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $events->previousPageUrl() ? '' : 'disabled' }}">
                @if($events->currentPage() >= 2)
                <a class="page-link" href="?page={{ $events->currentPage() - 1}}" tabindex="-1" aria-disabled="{{ $events->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
                @endif
            </li>
            @for($i=1;$i<=$events->lastPage();$i++)
                <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="?page={{$i}}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $events->nextPageUrl() ? '' : 'disabled' }}">
                    @if($events->currentPage() < $events->lastPage())
                        <a class="page-link" href="?page={{ $events->currentPage() + 1}}" aria-disabled="{{ $events->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                        @endif
                </li>
        </ul>
    </nav>
</div>
@endsection