@extends('layout')

@section('title', 'Home')

@section('content')

<div class="container mt-3">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($events as $event)
        <div class="col">
            <a href="{{route('event.show', $event->id)}}">
                <div class="card h-100">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top" alt="Hollywood Sign on The Hill" />
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name}}</h5>
                        <p class="card-text">
                            {{Str::limit($event->description, 50)}}
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
</div>

@endsection