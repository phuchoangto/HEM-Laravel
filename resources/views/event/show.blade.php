@extends('layout')

@section('title', 'Home')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-8">
            <div class="card h-100">
                <img src="{{{Storage::url($event->image)}}}">
                <div class="card-body">
                    <h5 class="card-title">Name: {{$event->name}}</h5>
                </div>

                <ul class="list-group list-group-light list-group-small">
                    <li class="list-group-item px-4">Falcuty: {{$event->faculty_id}}</li>
                    <li class="list-group-item px-4">Description: {{$event->description}}</li>
                    <li class="list-group-item px-4">Location: {{$event->location}}</li>
                </ul>
                <div class="card-footer text-muted">
                    {{Carbon\Carbon::parse($event->start_at)->diffForHumans()}}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Event info</h5>
                </div>
                <ul class="list-group list-group-light list-group-small">
                    <li class="list-group-item px-4">
                        <i class="fas fa-id-card-alt"></i>
                        Faculty: {{$event->faculty->name}}
                    </li>
                    <li class="list-group-item px-4">
                        <i class="fas fa-calendar-alt"></i>
                        Start at: {{Carbon\Carbon::parse($event->start_at)->format('d/m/Y H:i')}}
                    </li>
                    <li class="list-group-item px-4">
                        <i class="fas fa-calendar-alt"></i>
                        End at: {{Carbon\Carbon::parse($event->end_at)->format('d/m/Y H:i')}}
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection