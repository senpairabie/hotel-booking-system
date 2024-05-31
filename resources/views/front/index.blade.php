@extends('front\layout')

@section('content')
    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to Hotel Booking</h1>
        <p class="lead">Find and book the perfect room for your stay.</p>

        @if (Auth::check() && Auth::user()->role === 'admin')
            <a class="btn btn-primary btn-lg" href="/rooms/create" role="button">Dashboard</a>
            @elseif (!Auth::check())
            <a class="btn btn-primary btn-lg" href="/login" role="button">Get Started</a>
            @else
        @endif

        <!-- @if (Auth::check())

        @endif -->

    </div>

    <!-- Content Section 1 -->
    <div class="container content-section text-center">
    <div class="row">
        @foreach ($rooms as $itm)   
        <div class="col-md-4 mb-4"> 
            <div class="card h-100"> 
                <div class="card-body">
                    <h5 class="card-title">Room Number: {{$itm->number}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$itm->type}}</h6>
                    <p class="card-text">{{$itm->description}}</p>
                    <p class="card-text"><strong>Price: ${{$itm->price}}</strong></p>
                    <div class="room-status">
                        @if ($itm->status == 'available')
                        <span class="badge badge-success">Available</span>
                        @elseif ($itm->status == 'booked')
                        <span class="badge badge-secondary">Booked</span>
                        @else
                        <span class="badge badge-warning">Pending</span>
                        @endif
                    </div>
                    @if ($itm->status == 'available')
                    <form action="{{route('reservations.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="room_id" value="{{$itm->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <input type="hidden" name="status" value="pending">
                        <button class="btn btn-primary mt-3">Request Booking</button>
                    </form>
                    @elseif ($itm->status == 'booked')
                    <button class="btn btn-secondary mt-3" disabled>Booked</button>
                    @else
                    <button class="btn btn-warning mt-3" disabled>Pending</button>
                    @endif
                </div>
            </div>
        </div> 
        @endforeach
    </div>
</div>

    <!-- Content Section 2 -->
    <div class="container content-section text-center">
        <h2>About Us</h2>
        <p>Learn more about our hotel and the services we offer.</p>
    </div>

@endsection
