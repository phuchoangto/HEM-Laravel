@extends('layout')

@section('title', 'Home')

@section('content')



<div class="container">
    <section class="mx-auto my-5">

        <div class="card booking-card v-2 mt-2 mb-4 rounded-bottom">
            <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                <img src="{{{Storage::url($event->image)}}}" class="img-fluid">
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h4 class="card-title font-weight-bold"><a>{{$event->name}}</a></h4>
                <ul class="list-unstyled list-inline mb-2">
                    <li class="list-inline-item"><i class="fas fa-graduation-cap"></i> {{$event->faculty->name}}</li> <br>
                    <li class="list-inline-item"><i class="fas fa-map-marker-alt"></i> {{$event->location}}</li>
                </ul>
                <hr class="my-4">
                <div class="card-text">
                    {!! htmlspecialchars_decode($event->description, ENT_NOQUOTES) !!}
                </div>
                <hr class="my-4">
                <p class="h5 font-weight-bold mb-4">Opening hours</p>
                <ul class="list-unstyled d-flex justify-content-start align-items-center mb-0">
                    <li>
                        Start at: {{Carbon\Carbon::parse($event->start_at)->format('l d/m/Y')}}
                    </li>

                    <li>
                        <div class="chip ms-3">
                            {{ Carbon\Carbon::parse($event->start_at)->format('h:i A') }}
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled d-flex justify-content-start align-items-center mb-0">
                    <li>
                        End at: {{Carbon\Carbon::parse($event->end_at)->format('l d/m/Y')}}
                    </li>

                    <li>
                        <div class="chip ms-3">
                            {{ Carbon\Carbon::parse($event->end_at)->format('h:i A') }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </section>
</div>

@endsection